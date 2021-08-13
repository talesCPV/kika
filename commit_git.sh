
#!/bin/bash
# Upload files to Github - https://github.com/talesCPV/kika.git

curl -H 'Authorization: token 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' https://github.com/talesCPV/kika.git

git init

git add .

git commit -m "by_script"

git remote add origin "https://github.com/talesCPV/kika.git"

git commit -m "by_script"

git push -f origin master

