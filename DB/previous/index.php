<?
include("config.php");

if(file_exists($headerfile)){
include($headerfile);
}

if(isSet($_REQUEST['quiz'])){
$quizhash = $_REQUEST['quiz'];
$result = mysql_query("SELECT id,title,intro from quizconfig where hash = '".mysql_real_escape_string($quizhash)."'");
if(mysql_num_rows($result)>0){
	$row = mysql_fetch_assoc($result);	
	
echo "<h2>".$row["title"]."</h2>".$row["intro"];
?>

<form action="results.php" method=post>
<?
$result = mysql_query("SELECT id,title,intro from quizconfig where hash = '".mysql_real_escape_string($quizhash)."'");
if(mysql_num_rows($result)>0){

$row = mysql_fetch_assoc($result);
echo "<input type=hidden name=quizhash value='$quizhash'><table border=0 width=\"100%\">";
	
$result = mysql_query("SELECT * from pqa where quizid  = '{$row["id"]}' ORDER BY `order`");

if(mysql_num_rows($result)>0){
while($row = mysql_fetch_assoc($result)){	
	
	$answers = unserialize($row["answer"]);
	$answers = custom_shuffle($answers);
?>
	<tr>
      <td colspan=2 bgcolor="#999999"><font color="#000000"><? echo $row["question"]; ?></font></td>
    </tr>

<?


	foreach($answers as $k=>$v){
?>
	
		<tr>
			<td valign=top width=1><input type="radio" name="q_<? echo $row["order"]; ?>" value="<? echo $k; ?>">
			<td><? echo $v; ?></td>
		</td></tr>
<?
		}
	}
}

?>
</TABLE>
<BR><BR>
<input type="submit" value="Give me my results!"></center>
</form>

<?
	}
}else{
	echo "quiz retrieval failure";
}
}else{
?>
This will be a menu of available quizzes.
<?	
	$result = mysql_query("SELECT hash,title from quizconfig order by title");
	if(mysql_num_rows($result)>0){
		while($row = mysql_fetch_assoc($result)){
			echo "<a href='?quiz=".$row["hash"]."'>".$row["title"]."</a><br>";
		}
	}

}
// Display the footer
if(file_exists($footerfile)){
include($footerfile);
}

function custom_shuffle($my_array = array()) {
  $copy = array();
  while (count($my_array)) {
    // takes a rand array elements by its key
    $element = array_rand($my_array);
    // assign the array and its value to an another array
    $copy[$element] = $my_array[$element];
    //delete the element from source array
    unset($my_array[$element]);
  }
  return $copy;
}

?>
