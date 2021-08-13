
#!/bin/bash
# Upload files to Github - https://github.com/talesCPV/kika.git
# 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


curl -H 'Authorization: token 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' https://github.com/talesCPV/kika.git

git init

git add .

git commit -m "by_script"

git remote add origin "https://github.com/talesCPV/kika.git"

git commit -m "by_script"

git push -f origin master

