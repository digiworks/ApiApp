
<html>
<head>
    <link rel="shortcut icon"                    
   href="/static/images/favicon/favicon-32x32.png">                                                    
                                                                                            
  <link rel="icon"                             
   type="image/vnd.microsoft.icon"                                                          
   href="/static/images/favicon/favicon-32x32.png">
   
    {{stylesheets}}
    
    {{imports}}
</head>

<body>
<div id="root">{{serverside}}</div>
<script  type="text/babel">
    {{javascript}}
</script>
</body>
<script  type="text/babel">
    function init(){
        ReactDOM.hydrate(
          <App />,
          document.getElementById("root")
        );
    }
    init();
</script>
</html>