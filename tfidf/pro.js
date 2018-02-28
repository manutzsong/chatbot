// grab the packages we need
const express = require('express');
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

app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

var receive_text; //place to receive text
//var receive_stopword;
var receive_stopword_array = [];


        con.query("SELECT word FROM stopword", function (err, result, fields) {
            if (err) throw err;
            result = result.map(obj => obj.word);
            app.receive_stopword_array = result;
            //console.log(result);
            });




// webhook callback
//https://stackoverflow.com/questions/40537972/compare-2-arrays-and-show-unmatched-elements-from-array-1
//https://stackoverflow.com/questions/40639589/how-do-i-return-callback-of-mysql-query-and-push-to-an-array-in-node-js
//http://www.chrisumbel.com/article/node_js_natural_language_porter_stemmer_lancaster_bayes_naive_metaphone_soundex
app.get('/test', function(request, response){

    //stem word and tokenize in 1 go lmao
    var stem = "kill me please dude".tokenizeAndStem(); 
    //var stem = request.body.line_text.tokenizeAndStem();  

    //console.log(stem);  

    //app.receive_text = request.body.line_text;
    //var split_result = app.receive_text.split(" ");


    //----------- FILTER THROUGH ARRAY OF STOPWORDS- -- -
     var result_stem =stem.filter( function(n) { return !this.has(n) }, new Set(app.receive_stopword_array) );
    //console.log(res);

    
    //var stem = request.body.line_text.tokenizeAndStem();  

    //------------- QUERY RESULT ABOVE ----------
    before_join_quote = result_stem.join("` * `");

    after_join_quote = "`" + before_join_quote + "`";

    //var query = `SELECT SUM(${after_join_quote}) ` + "as result_prob, its_cat FROM `word_prob` GROUP BY `its_cat` ORDER BY result_prob DESC LIMIT 5";
    var query = "SELECT SUM(`2-2-5` * `mis`) as result_prob, its_cat FROM `word_prob` GROUP BY `its_cat` ORDER BY result_prob DESC LIMIT 5";
    console.log(query);

    var hold_result;
    con.query(query, function (err, result, fields) {
            
            hold_result = result;
            console.log(hold_result);
    
        });
        con.end();
    console.log(hold_result);
});


//run server
const port = 8001;
app.listen(port, () => {
  console.log(`listening on ${port}`);
});