let fs = require('fs')
let path = require('path')

let authTemplate = path.join(__dirname, '../auth.template.json')
let authSecret = path.join(__dirname, '../auth.secret.json')

let statsTemplate = path.join(__dirname, '../build/stats.template.php')
let statsSecret = path.join(__dirname, '../build/stats.secret.php')

if(!fs.existsSync(authSecret)) {
  try {
    console.log('Creating auth.secret.json using auth.template.json - please add your FTP details to this file')
    fs.createReadStream(authTemplate).pipe(fs.createWriteStream(authSecret))
  }
  catch(ex) {
    console.error('Tried to create auth.secret.json using template, but failed: ', ex)
  }
}

if(!fs.existsSync(statsSecret)) {
  try {
    console.log('Creating stats.secret.php using stats.template.php - please add your database connection details to this file')
    fs.createReadStream(statsTemplate).pipe(fs.createWriteStream(statsSecret))
  }
  catch(ex) {
    console.error('Tried to create stats.secret.php using template, but failed: ', ex)
  }
}
