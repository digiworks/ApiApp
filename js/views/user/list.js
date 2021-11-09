function IndexPage() {
    const [waiting, setWaiting] = React.useState(false);
    
    var hd = [
        {text: "Nome"},
        {text: "Cognome"},
        {text: "Stato"}
    ];
    
    const columns = [
        {field: "Name"},
        {field: "surname"},
        {field: "Status"}
    ];
    const actions = [
       {
           icon: 'edit',
           tooltip: 'Edit Index',
           text: '',
           onClick: (event, rowData) => {
               if(baseApp.isWeb()){
                   alert("Edit");
               }
           }
       },
       {
           icon: 'delete',
           tooltip: 'Delete Index',
           text: '',
           onClick: (event, rowData) => {
              if(baseApp.isWeb()){
                   alert("Delete");
               }
           }
       }
   ];
    
    const createuser = (e) => {
      e.preventDefault();
      setWaiting(true);
      let path = "/createuser";
      baseApp.redirect(path);
    };
    
    
    return (
        <div>
            <Backdrop
                sx={{ color: "#fff", zIndex: (theme) => theme.zIndex.drawer + 1 }}
                open={waiting}
            >
                <CircularProgress color="inherit" />
            </Backdrop>
            <Box pb={3} pl={1}>
                <Button sx={{ border: "1px dashed grey" }} id = "id_button_1" onClick={createuser}>Add</Button>
            </Box>
            <DataGridRest
                restUrl = "/api/user/paginate"
                headers = {hd}
                keyColumn = "Id"
                columns = {columns}
                actions = {actions}
            />
        </div>
            );
}

