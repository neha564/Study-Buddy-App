<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.Connection"%>
<center><h1>My SentBox</h1></center><br><br><br><br>
<table border="1" align="center" width="60%">
<tr>
<th>To</th>
<th>Subject</th>
<th><input type=button value="delete"></th>
</tr>
<%
String id = request.getParameter("uname");
String driver = "com.mysql.jdbc.Driver";
String connectionUrl = "jdbc:mysql://localhost:3306/";
String database = "emailsoftware";
String userid = "pavan";
String password = "kalyan";
try {
Class.forName(driver);
} catch (ClassNotFoundException e) {
e.printStackTrace();
}
Connection connection = null;
Statement statement = null;
ResultSet resultSet = null;
String user_id=session.getAttribute("emailid").toString();
String user_pwd=request.getParameter("pwd");
int flag=0;
try{
connection = DriverManager.getConnection(connectionUrl+database, userid, password);
statement=connection.createStatement();
String sql ="select * from mails where mfrom='"+user_id+"' and sentbox=1";
resultSet = statement.executeQuery(sql);
while(resultSet.next()){%>
<tr>
<td><%=resultSet.getString("mto") %></td>
<td><%=resultSet.getString("subject") %></td>
<td align=center><input type=checkbox></td>

</tr><%
}
%>
</table>
<%
connection.close();
} catch (Exception e) {
out.println(e.getMessage());
}
%>
