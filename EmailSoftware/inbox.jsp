<html>
<body>
<br><br><br><br><br>
<table align=right><tr><td><a href="logout.jsp">Logout</a></td></tr></table>
<%
String emailid="";
if(session.getAttribute("emailid")!=null){
emailid=session.getAttribute("emailid").toString();
%>
<center><h1>

<%
out.println("Dear "+emailid+" <br> Your ");
%>
Inbox Reached</h1></center>
<%
}
else
response.sendRedirect("login.jsp");
%>
</body></html>
