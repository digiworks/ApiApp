const mdTheme = createTheme();
const drawerWidth = 240;


function Copyright(props) {
  return (
    <Typography variant="body2" color="text.secondary" align="center" {...props}>
      {"Copyright © "}
      <Link color="inherit" href="https://google.it">
        Your Website
      </Link>{" "}
      {new Date().getFullYear()}
      {"."}
    </Typography>
  );
}

const AppDrawer = styled(Drawer, { shouldForwardProp: (prop) => prop !== "open" })(
  ({ theme, open }) => ({
    "& .MuiDrawer-paper": {
      position: "relative",
      whiteSpace: "nowrap",
      width: drawerWidth,
      transition: theme.transitions.create("width", {
        easing: theme.transitions.easing.sharp,
        duration: theme.transitions.duration.enteringScreen,
      }),
      boxSizing: "border-box",
      ...(!open && {
        overflowX: "hidden",
        transition: theme.transitions.create("width", {
          easing: theme.transitions.easing.sharp,
          duration: theme.transitions.duration.leavingScreen,
        }),
        width: theme.spacing(7),
        [theme.breakpoints.up("sm")]: {
          width: theme.spacing(9),
        },
      }),
    },
  }),
);



function App() {
    const [open, setOpen] = React.useState(true);
    const [waiting, setWaiting] = React.useState(false);

    const toogleLogin = (e) => {
      e.preventDefault();
      setWaiting(true);
      let path = "/";
      baseApp.redirect(path);
    };
    
    const toogleDashboard = (e) => {
      e.preventDefault();
      setWaiting(true);
      let path = "/dashboard";
      baseApp.redirect(path);
    };
    
    const toogleUser = (e) => {
      e.preventDefault();
      setWaiting(true);
      let path = "/userslist";
      baseApp.redirect(path);
    };

   const toggleDrawer = (e) => {
      setOpen(!open);
    };
    
    const toogleLogout = (e) => {
      baseApp.logout();
      let path = "/";
      baseApp.redirect(path);
    };
    
    const mainListItems = (
      <div>
        <ListItem button onClick={toogleDashboard}>
          <ListItemIcon>
             <Icon >dashboard</Icon>
          </ListItemIcon>
          <ListItemText primary={baseApp.translations().t("Dashboard", "app")} />
        </ListItem>
        <ListItem button onClick={toogleUser}>
          <ListItemIcon>
             <Icon >face</Icon>
          </ListItemIcon>
          <ListItemText primary={baseApp.translations().t("Users", "app")} />
        </ListItem>
      </div>
    );

    const secondaryListItems = (
      <div>
        <ListSubheader inset>{baseApp.translations().t("Tools", "app")}</ListSubheader>
        <ListItem button onClick={toogleLogout}>
          <ListItemIcon>
            <Icon >logout</Icon>
          </ListItemIcon>
          <ListItemText primary={baseApp.translations().t("LogOut", "app")} />
        </ListItem>
      </div>
    );
    
  
  return (
    <div>
        <ThemeProvider theme={mdTheme}>
        <Backdrop
        sx={{ color: "#fff", zIndex: (theme) => theme.zIndex.drawer + 1 }}
        open={waiting}
      >
        <CircularProgress color="inherit" />
      </Backdrop>
      <Box sx={{ display: "flex" }}>
        <CssBaseline />
        <AppBar position="absolute" open={open}>
          <Toolbar
            sx={{
              pr: "24px", /* keep right padding when drawer closed */
            }}
          >
            <IconButton
              edge="start"
              color="inherit"
              aria-label="open drawer"
              onClick={toggleDrawer}
              sx={{
                marginRight: "36px",
                ...(open && { display: "none" }),
              }}
            >
              <Icon >menu</Icon>
            </IconButton>
            <Typography
              component="h1"
              variant="h6"
              color="inherit"
              noWrap
              sx={{ flexGrow: 1 }}
            >
              Dashboard
            </Typography>
            <IconButton color="inherit">
              <Badge badgeContent={4} color="secondary">
                <Icon>notifications</Icon>
              </Badge>
            </IconButton>
          </Toolbar>
        </AppBar>
        <AppDrawer variant="permanent" open={open}>
          <Toolbar
            sx={{
              display: "flex",
              alignItems: "center",
              justifyContent: "flex-end",
              px: [1],
            }}
          >
            <IconButton onClick={toggleDrawer}>
              <Icon >chevron_left</Icon>
            </IconButton>
          </Toolbar>
          <Divider />
          <List>{mainListItems}</List>
          <Divider />
          <List>{secondaryListItems}</List>
        </AppDrawer>
         <Box
          component="main"
          sx={{
            flexGrow: 1,
            height: "100vh",
            overflow: "auto"
          }}
        >
         <Toolbar />
          <Container maxWidth="lg" sx={{ mt: 4, mb: 4 }}>
            <IndexPage apiGateway={baseApp.indexPageApiGateway} pageParams ={pageParams}/>
            <Copyright sx={{ pt: 4 }} />
          </Container>
        </Box>
      </Box>
    </ThemeProvider>
    </div>
  );
}


