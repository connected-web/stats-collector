let fs = require('fs')
let path = require('path')

let template = path.join(__dirname, '../auth.template.json')
let secret = path.join(__dirname, '../auth.secret.json')

if(!fs.existsSync(secret)) {
  try {
    console.log('Creating auth.secret.json using auth.template.json - please add your FTP details to this file')
    fs.createReadStream(template).pipe(fs.createWriteStream(secret))
  }
  catch(ex) {
    console.error('Tried to create auth.secret.json using template, but failed: ', ex)
  }
}
