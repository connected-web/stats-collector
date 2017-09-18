var auth = require('../auth.secret.json'),
  ftpClient = require('ftp-client'),
  config = {
    host: auth.host,
    port: 21,
    user: auth.user,
    password: auth.password
  },
  options = {
    logging: 'basic'
  },
  client = new ftpClient(config, options);

client.connect(function () {
    client.upload(['build/*.php', 'build/*.html', 'build/css/*.css'], '/', {
        baseDir: 'build',
        overwrite: 'older'
    }, function (result) {
        console.log(result);
    });
});
