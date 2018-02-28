// app.js
const mysql = require('mysql');
const natural = require('natural'),
stemmer = natural.PorterStemmer.attach();
// First you need to create a connection to the db
const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "128029486",
    database: "keras"
  }); // mysql connection


//lets pull data from db
con.query('SELECT * FROM answer', function (err, rows, fields) {
    if (err) throw err;
    else {
      con.query('SELECT * FROM stopword', function (err, rows_2nd, fields) {
        if (err) throw err;
        else {
          var result_stopword = rows_2nd.map(obj => obj.word);
          fwd_data(rows,result_stopword);
        }
      });
    }
  });



//hold func
function fwd_data(data_row,data_row_stop) {

  var data_json = [];
  for (i=0;i<=data_row.length-1;i++) {
    data_json[i] = {
                    "id": data_row[i].id,
                    "answer": data_row[i].answer,
                    "catalog": data_row[i].catalog
                  };


  }

  do_calc(data_json,data_row_stop);



}//end func fwd_data
function do_calc(rec_ans,rec_stop) {
  //console.log(rec_ans);
  var ans_array = [];

  for (i=0;i<=rec_ans.length-1;i++) {
    var cur_ans = rec_ans[i].answer;
    var cur_ans_stem = cur_ans.tokenizeAndStem();
    ans_array[i] = {
      "id" : rec_ans[i].id,
      "answer" : cur_ans_stem.filter( function(n) { return !this.has(n) }, new Set(rec_stop) ),
      "catalog" : rec_ans[i].catalog
    }
  }
  do_insert(ans_array);
}

function do_insert(what_ins) {
  var array_ans_ins = [];
  //console.log(what_ins[2].answer);
  for (i=0;i<=what_ins.length-1;i++) {
      
      var reserve_ans = what_ins[i].answer.join(" ");
      console.log(reserve_ans);
      array_ans_ins[i]= [what_ins[i].id,reserve_ans,what_ins[i].catalog];
  }
  //console.log(array_ans_ins);
  var sql = "INSERT INTO `answer_after` (`id`, `answer`, `catalog`) VALUES ?";

con.query(sql, [array_ans_ins], function(err) {
    if (err) throw err;
    console.log("LMAO");
});

}


