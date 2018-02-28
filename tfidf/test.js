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




app.use(function(req, res, next){
    console.log(req.body.line_uid);
    var sql = "INSERT INTO `chat_log` (`uid`, `message`) VALUES ?";
    var values = [
        [req.body.line_uid, req.body.line_text]
    ];
      con.query(sql, [values], function (err, result) {
        if (err) throw err;
        console.log("Number of records inserted: " + result.affectedRows);
      });

    next();
});




app.post('/', function (req, res) {
    var stem = req.body.line_text.tokenizeAndStem(); // [sit,xxxx]

    var stopword_set = [];

    con.query('SELECT * FROM stopword', function (err, rows, fields) {
        if (err) throw err;
        else {
          set_stopword(rows);
        }
      });

    function set_stopword(rec_text) {
        stopword_set = rec_text;
        var result_stem =stem.filter( function(n) { return !this.has(n) }, new Set(stopword_set) );
        //console.log(res.locals.stopword_list);
        //echo_back(result_stem);
        con.query('SHOW columns FROM word_count', function (err, rows, fields) {
            if (err) throw err;
            else {
                let col_name = rows.map(obj => obj.Field);
                let result_check_col = result_stem.filter( function(n) { return this.has(n) }, new Set(col_name) );
                console.log(col_name);
                console.log(result_check_col);


                if(result_check_col.length > 0){   
                    query_prob(result_check_col);
                }
                else {
                    echo_back("Look like we don\'t lnow these question");
                }
            }
      });
        

    }
    function echo_back(rec_text) {
        res.send(rec_text);

    }
    function query_prob(result_stem) {
        before_join_quote = result_stem.join("` * `");
        after_join_quote = "`" + before_join_quote + "`";
        var query = `SELECT SUM(${after_join_quote}) ` + "as result_prob, its_cat FROM `word_prob` GROUP BY `its_cat` ORDER BY result_prob LIMIT 5";
    
        //var query = "SELECT SUM(`program` * `mi`) as result_prob, its_cat FROM `word_prob` GROUP BY `its_cat` ORDER BY result_prob DESC LIMIT 5";
        con.query(query, function (err, rows, fields) {
            if (err) throw err;
            else {
                var result_prob = rows.map(obj => obj.result_prob);
                var result_word = rows.map(obj => obj.its_cat);
                query_ans(result_word,result_prob);
            }
      });
    }
    function query_ans(what_id,what_prob) {
            console.log(what_id);
            var query_ans = "SELECT LEFT(answer,15) as ans_reply FROM `answer` WHERE `id` IN (?) ORDER BY FIELD (id,?)";
            var values_ins = what_id;
            con.query(query_ans,[values_ins,values_ins], function (err, rows, fields) {
                if (err) throw err;
                else {
                    console.log(rows);
                    make_reply(what_prob,rows);
                }
          });



    }
    function make_reply(what_prob,what_ans) {
        console.log(what_ans);
        var ans_val = [];
        
        for (i=0;i<what_prob.length;i++) {

            if (what_prob[i] != 1) {
            ans_val.push(what_prob[i]+ " : " + what_ans[i]['ans_reply']);
            
        }
            if (i==what_prob.length-1) {
                console.log(ans_val);
                echo_back(ans_val);
            }
        }
    } 

    
    
    
});







const port = 8001;
app.listen(port, () => {
  console.log(`listening on ${port}`);
});