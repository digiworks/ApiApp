function IndexPage(props) {
    const [waiting, setWaiting] = React.useState(false);
    const [error, setError] = React.useState(false);
    const [errorMsg, setErrorMsg] = React.useState("");
    const validator = baseApp.formValidator();
    const [values, setValues] = React.useState({
        firstName: "",
        lastName: "",
        email: "",
        password: "",
        confirm_password: ""
    });
    
    const [pwdsShow, setPwdsShow] = React.useState({
        showPassword: false,
        showConfirmPassword: false,
    });

    const presentMsg = baseApp.translations().t("Email already present!", "signup");
    
    const handleSubmit = async (event) => {
        event.preventDefault();
        const formValid = validator.allValid();
        /*console.log(formValid);
         debugger;*/
        if (formValid) {
            validator.hideMessages();
            setWaiting(true);
            const data = new FormData(event.currentTarget);
            var result = await baseApp.fetch(props.apiGateway + "/api/user/register", baseApp.formDataToObject(data));
            if (result.status == "success") {
                if(result.message.message == "present"){
                    setErrorMsg(presentMsg);
                    setError(true);
                    setWaiting(false);
                }else{
                    let path = "/login";
                    baseApp.redirect(path);
                }
            } else {
                if (result.status == "error")
                {
                    console.log(result);
                    setError(true);
                    setWaiting(false);
                }
            }
        } else {
            validator.showMessages();
        }
    };
    
    const handleSigneIn = (event) => {
        setWaiting(true);
        baseApp.redirect(event.target.href);
    };
    
    
    const handleChange = name => event => {
            setValues({...values, [name]: event.target.value});
            validator.checkField(name, event.target.value);
        };
    const handleChangeCheckBox = name => event => {
            setValues({...values, [name]: event.target.checked});
            validator.checkField(name, event.target.checked);
        };
        
    const handleBlur = name => event => {
            setValues({...values, [name]: event.target.value});
            validator.checkField(name, event.target.value);
        };
    
    const handleClickShowPassword = () => {
        setPwdsShow({
          ...pwdsShow,
          showPassword: !pwdsShow.showPassword,
        });
    };
    const handleClickShowConfirmPassword = () => {
        setPwdsShow({
          ...pwdsShow,
          showConfirmPassword: !pwdsShow.showConfirmPassword,
        });
    };

    const handleMouseDownPassword = (event) => {
        event.preventDefault();
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
        <Collapse in={error}>
            <Alert variant="filled" severity="error"
                   action={
                            <IconButton
                            aria-label="close"
                            color="inherit"
                            size="small"
                            onClick={() => {setError(false);}
                            }
                            >
                                <Icon fontSize="inherit">close</Icon>
                            </IconButton>
                       }
                       sx={{mb: 2}}
                       >
                       {errorMsg}
            </Alert>
        </Collapse>
        <Box
          sx={{
            marginTop: 8,
            display: "flex",
            flexDirection: "column",
            alignItems: "center"
          }}
        >
            <Avatar sx={{ m: 1, bgcolor: "secondary.main" }}>
                <Icon>lock</Icon>
            </Avatar>
              <Typography component="h1" variant="h5">
                {baseApp.translations().t("signup", "userform")}
              </Typography>
          </Box>
          <Box component="form" autoComplete="off"  onSubmit={handleSubmit} sx={{ mt: 3 }}>
            <Grid container spacing={2}>
              <Grid item xs={12} sm={6}>
                <TextField
                  autoComplete="given-name"
                  name="firstName"
                  required
                  fullWidth
                  id="firstName"
                  label={baseApp.translations().t("name", "userform")}
                  autoFocus
                  value={values.firstName}  
                  onChange={handleChange("firstName")}
                  onBlur={handleBlur("firstName")}
                  error={!validator.fieldValid("firstName")}
                  helperText={validator.getFieldErrorMessages("firstName")}
                />
                {validator.addFieldRules("firstName", "required")}
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  required
                  fullWidth
                  id="lastName"
                  label={baseApp.translations().t("surname", "userform")}
                  name="lastName"
                  value={values.lastName}  
                  onChange={handleChange("lastName")}
                  onBlur={handleBlur("lastName")}
                  error={!validator.fieldValid("lastName")}
                  helperText={validator.getFieldErrorMessages("lastName")}
                />
                {validator.addFieldRules("lastName", "required")}
              </Grid>
              <Grid item xs={12}>
                <TextField
                  required
                  fullWidth
                  id="email"
                  label={baseApp.translations().t("email", "userform")}
                  name="email"
                  value={values.email}
                  onChange={handleChange("email")}
                  onBlur={handleBlur("email")}
                  error={!validator.fieldValid("email")}
                  helperText={validator.getFieldErrorMessages("email")}
                />
                {validator.addFieldRules("email", "required|email")}
              </Grid>
              <Grid item xs={12}>
                <TextField
                  required
                  fullWidth
                  name="password"
                  label={baseApp.translations().t("password", "userform")}
                  type={pwdsShow.showPassword ? 'text' : 'password'}
                  id="password"
                  value={values.password}
                  autoComplete="new-password"
                  onChange={handleChange("password")}
                  onBlur={handleBlur("password")}
                  error={!validator.fieldValid("password")}
                  helperText={validator.getFieldErrorMessages("password")}
                  InputProps={{
                        endAdornment: (
                                <InputAdornment position="end">
                                  <IconButton
                                    aria-label="toggle password visibility"
                                    onClick={handleClickShowPassword}
                                    onMouseDown={handleMouseDownPassword}
                                    edge="end"
                                  >
                                    {pwdsShow.showPassword ? <Icon>visibility_off</Icon> :  <Icon>visibility</Icon>}
                                  </IconButton>
                                </InputAdornment>
                        )
                    }}
                />
                {validator.addFieldRules("password", "required")}
              </Grid>
              <Grid item xs={12}>
                <TextField
                  required
                  fullWidth
                  name="confirm_password"
                  label={baseApp.translations().t("confirm_password", "userform")}
                  type={pwdsShow.showConfirmPassword ? 'text' : 'password'}
                  id="confirm-password"
                  value={values.confirm_password}
                  autoComplete="new-password"
                  onChange={handleChange("confirm_password")}
                  onBlur={handleBlur("confirm_password")}
                  error={!validator.fieldValid("confirm_password")}
                  helperText={validator.getFieldErrorMessages("confirm_password")}
                  InputProps={{
                        endAdornment: (
                                <InputAdornment position="end">
                                  <IconButton
                                    aria-label="toggle password visibility"
                                    onClick={handleClickShowConfirmPassword}
                                    onMouseDown={handleMouseDownPassword}
                                    edge="end"
                                  >
                                    {pwdsShow.showConfirmPassword ? <Icon>visibility_off</Icon> :  <Icon>visibility</Icon>}
                                  </IconButton>
                                </InputAdornment>
                        )
                    }}
                />
                {validator.addFieldRules("confirm_password", "required|same:password")}
              </Grid>
              <Grid item xs={12}>
                <FormControlLabel
                  control={<Checkbox value="allowExtraEmails" color="primary" />}
                  label="I want to receive inspiration, marketing promotions and updates via email."
                />
              </Grid>
            </Grid>
            <Button
              type="submit"
              fullWidth
              variant="contained"
              sx={{ mt: 3, mb: 2 }}
            >
              {baseApp.translations().t("signup", "userform")}
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


