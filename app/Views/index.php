 <html>
<body>

<form name="inpform" action="/result" method="post">
ServerName: <input type="text" name="servername"><br>
Type of Query: 
<select id="queryType" name="qry">
    <!--CPU LOAD | MEMORY LOAD | PROCESSES | DISK SIZE-->
  <option value="cpuload">CPU Load</option>
  <option value="memoryload">Memory Load</option>
  <option value="processes">Processes</option>
  <option value="disksize">Disk Size</option>
</select> 
<input type="submit">
</form>
</body>
</html>