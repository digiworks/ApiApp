/* User List
 *---------
*/
function IndexPage(props) {
    const [waiting, setWaiting] = React.useState(false);
    const [open, setOpen] = React.useState(false);
    const [data, setData] = React.useState([]);
    const [refresh, setRefresh] = React.useState(false);
    const filters = [
        {type: "text", id: "fltName", label:  baseApp.translations().t("name", "userform"), value: "", field: "Name" },
        {type: "text", id: "fltsurname", label:  baseApp.translations().t("surname", "userform"), value: "", field: "surname" },
        {type: "text", id: "fltemail", label: baseApp.translations().t("email", "userform"), value: "", field: "email" }
    ];
    
   const labels = { 
       "Active" : baseApp.translations().t("Active", "userform"),
       "Deactivated" : baseApp.translations().t("Deactivated", "userform")
    };
    var hd = [
        {text:  baseApp.translations().t("name", "userform"), numeric: 0, disablePadding: 0, field: "Name"},
        {text:  baseApp.translations().t("surname", "userform"), numeric: 0, disablePadding: 0, field: "surname"},
        {text:  baseApp.translations().t("email", "userform"), numeric: 0, disablePadding: 0, field: "email"},
        {text:  baseApp.translations().t("status", "userform"), numeric: 0, disablePadding: 0, field: "Status"}
    ];
    
    const columns = [
        {field: "Name"},
        {field: "surname"},
        {field: "email"},
        {field: (row) => { return (row.Status == 1 ? labels.Active : labels.Deactivated); }}
    ];
    
    const handleClose = () => {
        setOpen(false);
    };
    
    const handleAgree = async () => {
      setOpen(false);
      if(baseApp.isWeb()){
            setWaiting(true);
            var result = await baseApp.fetch(props.apiGateway + "/api/user/delete",data);
            
            if(result.status == "success"){
                 setWaiting(false);
                 setRefresh(true);
             }else{
                 if(result.status == "error")
                 {
                     setWaiting(false);
                 }
             }
              setRefresh(false);
      }
      setData([]);
    };
  
    const actions = [
       {
           icon: 'edit',
           tooltip: 'Edit Index',
           text: '',
           onClick: (event, rowData) => {
               if(baseApp.isWeb()){
                   event.preventDefault();
                   /*setData(rowData);*/
                   setWaiting(true);
                   let path = "/formuser?id=" + rowData.Id;
                   baseApp.redirect(path, props.apiGateway);
               }
           }
       },
       {
           icon: 'delete',
           tooltip: 'Delete Index',
           text: '',
           onClick: (event, rowData) => {
              setData(rowData);
              setOpen(true);
           }
       }
   ];
    
    const createuser = (e) => {
      e.preventDefault();
      setWaiting(true);
      let path = "/formuser";
      baseApp.redirect(path, props.apiGateway);
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
                <Button sx={{ border: "1px dashed grey" }} id = "id_button_1" onClick={createuser}>{baseApp.translations().t("add", "userform")}</Button>
            </Box>
            <DataGridRest
                restUrl = {props.apiGateway + "/api/user/paginate"}
                headers = {hd}
                keyColumn = "Id"
                columns = {columns}
                actions = {actions}
                filterFields = {filters}
                refresh = {refresh}
                orderByHeader = {"Name"}
                orderDirection = {"asc"}
                denseType = {true}
            />
            <Dialog
              open={open}
              onClose={handleClose}
              aria-labelledby="alert-dialog-title"
              aria-describedby="alert-dialog-description"
            >
              <DialogTitle id="alert-dialog-title">
                {baseApp.translations().t("Delete", "userlist")}
              </DialogTitle>
              <DialogContent>
                <DialogContentText id="alert-dialog-description">
                 {baseApp.translations().t("Sei sicuro di volere eliminare l'e'emento?", "userlist")}
                   
                </DialogContentText>
              </DialogContent>
              <DialogActions>
                <Button onClick={handleClose}>{baseApp.translations().t("No", "userlist")}</Button>
                <Button onClick={handleAgree} autoFocus>
                  {baseApp.translations().t("Yes", "userlist")}
                </Button>
              </DialogActions>
            </Dialog>
        </div>
            );
}

