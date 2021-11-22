function IndexPage() {
const [waiting, setWaiting] = React.useState(false);
const [error, setError] = React.useState(false);
const [values, setValues] = React.useState({
    showPassword: false
});
 
const handleSubmit = async (event) => {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    /*setWaiting(true);*/
    var result = await baseApp.fetch("/api/user/token", baseApp.formDataToObject(data));
    if(result.status == "success"){
        if(result.message.message ==  "ok"){
            if(baseApp.isWeb()){
               baseApp.login(result.message);

            }
            let path = "/dashboard";
            baseApp.redirect(path);
        }else{
            setError(true);
            setWaiting(false);
        }
    }else{
        if(result.status == "error")
        {
            setError(true);
            setWaiting(false);
        }
    }
    /*console.log({
      email: data.get("email"),
      password: data.get("password"),
    });*/
};

const handleClickShowPassword = () => {
    setValues({
      ...values,
      showPassword: !values.showPassword,
    });
};

const handleMouseDownPassword = (event) => {
    event.preventDefault();
};


const handleLink = (event) => {
    setWaiting(true);
};
    
    return (
     
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
              alignItems: "center"
            }}
          >
          <Collapse in={error}>
                <Alert variant="filled" severity="error"
                action={
                        <IconButton
                          aria-label="close"
                          color="inherit"
                          size="small"
                          onClick={() => {
                            setError(false);
                          }}
                        >
                        <Icon fontSize="inherit">close</Icon>
                        </IconButton>
                      }
                      sx={{ mb: 2 }}
                >
                   Errore durante il login!
                </Alert>
            </Collapse>
            <Avatar sx={{ m: 1, bgcolor: "secondary.main" }}>
               <Icon>lock</Icon>
             </Avatar>
             <Typography component="h1" variant="h5">
               Sign in
             </Typography>
        </Box>
          <Box component="form"  autoComplete="off" onSubmit={handleSubmit} sx={{ mt: 1 }}>
            <TextField
              margin="normal"
              required
              fullWidth
              id="email"
              label="Email Address"
              name="email"
              autoComplete="email"
              autoFocus
            />
            <TextField
              margin="normal"
              required
              fullWidth
              name="password"
              label="Password"
              type={values.showPassword ? 'text' : 'password'}
              id="password"
              autoComplete="new-password"
              InputProps={{
                    endAdornment: (
                            <InputAdornment position="end">
                              <IconButton
                                aria-label="toggle password visibility"
                                onClick={handleClickShowPassword}
                                onMouseDown={handleMouseDownPassword}
                                edge="end"
                              >
                                {values.showPassword ? <Icon>visibility_off</Icon> :  <Icon>visibility</Icon>}
                              </IconButton>
                            </InputAdornment>
                    )
                }}
            />
            <FormControlLabel
              control={<Checkbox value="remember" color="primary" />}
              label="Remember me"
            />
            <Button
              type="submit"
              fullWidth
              variant="contained"
              sx={{ mt: 3, mb: 2 }}
            >
              Sign In
            </Button>
            <Grid container>
              <Grid item xs>
                <Link href="/forgot" variant="body2" onClick={handleLink}>
                  Forgot password?
                </Link>
              </Grid>
              <Grid item>
                <Link href="/signup" variant="body2" onClick={handleLink}>
                  {"Don't have an account? Sign Up"}
                </Link>
              </Grid>
            </Grid>
          </Box>
        </React.Fragment>
     
    );
}

