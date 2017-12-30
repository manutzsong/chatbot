<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<form id="example">
<input name="textbox">
<input type=submit name="submitbuttonname" value="submit"
    onClick="$.post('save.php', $('form#example').serialize())">
   </form>