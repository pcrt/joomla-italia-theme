#!/bin/bash
#
# Costruisce i pacchetti installabili da caricare in Joomla
# (Sistema > Installa > Carica file di pacchetto).
#
# Perche' serve: in questo repository i file stanno nella posizione che
# occupano DENTRO un sito Joomla gia' installato (templates/..., media/...),
# comoda da leggere e da confrontare. L'installatore di Joomla invece si
# aspetta un pacchetto in cui la cartella "media" sta DENTRO il template,
# come dichiarato in templateDetails.xml:
#
#     <media destination="templates/site/joomla-italia-theme" folder="media">
#
# Questo script riorganizza i file nel modo giusto e produce due zip.
#
# Uso:   bash build.sh
# Esito: dist/joomla-italia-theme-<versione>.zip
#        dist/plg_system_singleedit-<versione>.zip

set -eu
cd "$(dirname "$0")"
OUT="dist"
rm -rf "$OUT" .build
mkdir -p "$OUT" .build

VER_TPL=$(grep -o '<version>[^<]*</version>' templates/joomla-italia-theme/templateDetails.xml | head -1 | sed 's/<[^>]*>//g')
VER_PLG=$(grep -o '<version>[^<]*</version>' plugins/system/singleedit/singleedit.xml | head -1 | sed 's/<[^>]*>//g')

# crea uno zip da <cartella> in <file>. Usa "zip" se c'e', altrimenti python3:
# cosi' lo script funziona anche dove zip non e' installato.
fai_zip() {
  local dir="$1" out="$2"
  if command -v zip >/dev/null 2>&1; then
    ( cd "$dir" && zip -qr "$out" . )
  else
    python3 - "$dir" "$out" <<'PY'
import os, sys, zipfile
src, out = sys.argv[1], sys.argv[2]
with zipfile.ZipFile(out, "w", zipfile.ZIP_DEFLATED) as z:
    for root, _, files in os.walk(src):
        for f in files:
            p = os.path.join(root, f)
            z.write(p, os.path.relpath(p, src))
PY
  fi
}

echo "Template versione $VER_TPL"
cp -r templates/joomla-italia-theme .build/tpl
# la cartella media va DENTRO il template, come vuole il manifesto
cp -r media/templates/site/joomla-italia-theme .build/tpl/media
fai_zip .build/tpl "$PWD/$OUT/joomla-italia-theme-$VER_TPL.zip"

echo "Plugin versione $VER_PLG"
cp -r plugins/system/singleedit .build/plg
fai_zip .build/plg "$PWD/$OUT/plg_system_singleedit-$VER_PLG.zip"

rm -rf .build
echo
echo "Pacchetti creati:"
ls -lh "$OUT" | awk 'NR>1{print "  " $9 "  (" $5 ")"}'
echo
echo "Verifica del contenuto del pacchetto template:"
python3 - "$OUT/joomla-italia-theme-$VER_TPL.zip" <<'PY'
import sys, zipfile, collections
z = zipfile.ZipFile(sys.argv[1])
nomi = z.namelist()
primo = collections.Counter(n.split("/")[0] if "/" in n else n for n in nomi)
for k, v in sorted(primo.items()):
    print(f"  {k:24s} {v} file")
attesi = ["templateDetails.xml", "index.php", "media", "html", "language", "joomla.asset.json"]
mancanti = [a for a in attesi if a not in primo]
print("  ELEMENTI MANCANTI:", mancanti if mancanti else "nessuno")
PY
