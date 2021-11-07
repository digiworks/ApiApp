function IndexPage() {
  const [formats, setFormats] = React.useState(function (){ return (["bold", "italic"]);});
  const [open, setOpen] = React.useState(false);
  const today = new Date();
  const [values, setValues] = React.useState(today);

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };
  const handleAgree = () => {
    setOpen(false);
    let path = "/table";
    baseApp.redirect(path);
  };

  const handleFormat = function(event, newFormats){
    setFormats(newFormats);
  };

  return (
           <div>
            <React.Fragment>
                <CssBaseline />
                <Container maxWidth="sm">
    <ToggleButtonGroup
      value={formats}
      onChange={handleFormat}
      aria-label="text formatting"
    >
        
      <ToggleButton value="bold" aria-label="bold">
        <Icon color="primary">add_circle</Icon>
      </ToggleButton>
      <ToggleButton value="italic" aria-label="italic">
        <Icon color="primary">save</Icon>
      </ToggleButton>
      <ToggleButton value="underlined" aria-label="underlined">
        <Icon color="primary">delete</Icon>
      </ToggleButton>
    </ToggleButtonGroup>
    <Box sx={{ width: "100%", maxWidth: 360, bgcolor: "background.paper" }}>
      <nav aria-label="main mailbox folders">
        <List>
          <ListItem disablePadding>
            <ListItemButton>
              <ListItemIcon>
                <Icon color="primary">inbox</Icon>
              </ListItemIcon>
              <ListItemText primary="Inbox" />
            </ListItemButton>
          </ListItem>
          <ListItem disablePadding>
            <ListItemButton>
              <ListItemIcon>
                <Icon color="primary">drafts</Icon>
              </ListItemIcon>
              <ListItemText primary="Drafts" />
            </ListItemButton>
          </ListItem>
        </List>
      </nav>
      <Divider />
      <nav aria-label="secondary mailbox folders">
        <List>
          <ListItem disablePadding>
            <ListItemButton>
              <ListItemText primary="Trash" />
            </ListItemButton>
          </ListItem>
          <ListItem disablePadding>
            <ListItemButton component="a" href="#simple-list">
              <ListItemText primary="Spam" />
            </ListItemButton>
          </ListItem>
        </List>
      </nav>
    

            <Button variant="outlined" onClick={handleClickOpen}>
              Open alert dialog
            </Button>
            <Dialog
              open={open}
              onClose={handleClose}
              aria-labelledby="alert-dialog-title"
              aria-describedby="alert-dialog-description"
            >
              <DialogTitle id="alert-dialog-title">
                {"Use Google's location service?"}
              </DialogTitle>
              <DialogContent>
                <DialogContentText id="alert-dialog-description">
                  Let Google help apps determine location. This means sending anonymous
                  location data to Google, even when no apps are running.
                   <DatePicker 
                        render={<DatePickerInput />}
                        months={months}
                        weekDays={weekDays}
                        value={values} 
                        onChange={setValues}
                    />
                </DialogContentText>
              </DialogContent>
              <DialogActions>
                <Button onClick={handleClose}>Disagree</Button>
                <Button onClick={handleAgree} autoFocus>
                  Agree
                </Button>
              </DialogActions>
            </Dialog>
            
            
            
      </Box>
     </Container>
                </React.Fragment>
            </div>
  );
}