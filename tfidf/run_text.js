// grab the packages we need

const bodyParser = require('body-parser');
const mysql = require('mysql');
const natural = require('natural'),
stemmer = natural.PorterStemmer.attach();

const app = express();

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "128029486",
    database: "keras"
  }); // mysql connection



  con.query('SELECT * FROM stopword', function (err, rows, fields) {
    if (err) throw err;
    else {
      set_stopword(rows);
    }
  });

