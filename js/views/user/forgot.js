function IndexPage(props) {
const [waiting, setWaiting] = React.useState(false);
     
const handleSubmit = (event) => {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    
    console.log({
      email: data.get("email"),
    });
};

const handleSigneIn = (event) => {
    setWaiting(true);
    baseApp.redirect(event.target.href, props.apiGateway);
};
    
    return (
     <div>
         <React.Fragment>
         <Backdrop
            sx={{ color: "#fff", zIndex: (theme) => theme.zIndex.drawer + 1 }}
            open={waiting}
          >
            <CircularProgress color="inherit" />
        </Backdrop>
        <Box
            sx={{
              marginTop: 8,
              display: "flex",
              flexDirection: "column",
              alignItems: "center",
            }}
          >
            <Avatar sx={{ m: 1, bgcolor: "secondary.main" }}>
               <Icon>lock</Icon>
             </Avatar>
             <Typography component="h1" variant="h5">
               {baseApp.translations().t("forgotpassword_title", "userform")}
             </Typography>
        </Box>
          <Box component="form" onSubmit={handleSubmit} sx={{ mt: 1 }}>
            <TextField
              required
              margin="normal"
              required
              fullWidth
              id="email"
              label={baseApp.translations().t("email", "userform")}
              name="email"
              autoComplete="email"
              autoFocus
            />
            <Button
              type="submit"
              fullWidth
              variant="contained"
              sx={{ mt: 3, mb: 2 }}
            >
              {baseApp.translations().t("send", "userform")}
            </Button>
            <Grid container justifyContent="flex-end">
              <Grid item>
                <Link href="/login" onMouseDown ={handleSigneIn} variant="body2">
                  {baseApp.translations().t("already_account", "userform")}
                </Link>
              </Grid>
            </Grid>
          </Box>
        </React.Fragment>
     </div>
    );
}


