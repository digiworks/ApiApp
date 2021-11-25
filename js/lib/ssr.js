
<html>
<head>
    <link rel="shortcut icon"                    
   href="/static/images/favicon/favicon-32x32.png">                                                    
                                                                                            
  <link rel="icon"                             
   type="image/vnd.microsoft.icon"                                                          
   href="/static/images/favicon/favicon-32x32.png">
   
    {{stylesheets}}
   
<script type="text/javascript">
    var envConf = {{envConf}}; 
</script>
   
    {{imports}}
</head>

<body>
<div id="root">{{serverside}}</div>
<script  type="{{typeScript}}">
    {{javascript}}
</script>
</body>
<script  type="{{typeScript}}">
    {{launchScript}}
</script>
</html>