function IndexPage() {
 var id_field = "id";   
 
 const [values, setValues] = React.useState({
     name:"",
     surname:"",
     email:""
 });
 const validator = baseApp.formValidator();   
 const [error, setError] = React.useState(false);
 const [waiting, setWaiting] = React.useState(false);
 const [emailerror, setEmailError] = React.useState(false);
 
 baseApp.translations().loadResourceBundle("en", "userform", {
                                        name: "Nome del soggetto",
                                      }, true, true);
 
const submit = async (e) => {
    e.preventDefault();
    const formValid = validator.allValid();
    /*console.log(formValid);
    debugger;*/
    if (formValid){
        validator.hideMessages();
        setWaiting(true);
        const data = new FormData(e.currentTarget);
        var result = await baseApp.fetch("/api/user/save", baseApp.formDataToObject(data));
        if(result.status == "Success"){
            let path = "/userslist";
            baseApp.redirect(path);
        }else{
            if(result.status == "Error")
            {
                setError(true);
                setWaiting(false);
            }
        }
    }else{
        validator.showMessages();
    }
  };
    var id_value = null;
    if(baseApp.isWeb()){
        const qparams = baseApp.queryString();
        if(!qparams.get(id_field))
        {
            id_value = qparams.get(id_field)
        }
    }else
    {
        if(typeof queryStringValues[id_field] !== "undefined"){
            id_value = queryStringValues[id_field];
        }
    }
  const acordion_icon = <Icon>expand_more</Icon>;
  
  const handleChange = name => event => {
    setValues({ ...values, [name]: event.target.value });
    validator.checkField(name, event.target.value);
  };
  const handleBlur = name => event => {
    setValues({ ...values, [name]: event.target.value });
    validator.checkField(name, event.target.value);
  };
  
  return (
     <div>
        <React.Fragment>
        <CssBaseline />
        <Backdrop
            sx={{ color: "#fff", zIndex: (theme) => theme.zIndex.drawer + 1 }}
            open={waiting}
        >
            <CircularProgress color="inherit" />
        </Backdrop>
            <Container maxWidth="mm">
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
                       Errore durante il salvataggio!
                    </Alert>
                </Collapse>
                <FormControl fullWidth>
                    <Box 
                    pt={3}
                    pl={1}
                    method="post"
                    onSubmit={submit}
                    component="form"
                    autoComplete="off"
                    sx={{ bgcolor: "#cfe8fc", height: "50vh" }}
                    >
                        <Stack direction="row" spacing={2}>
                            <div>
                                <TextField id="name" name="name" 
                                    label = {baseApp.translations().t("name", "userform")}
                                    required 
                                    
                                    variant="outlined" 
                                    value={values.name}  
                                    onChange={handleChange("name")}
                                    onBlur={handleBlur("name")}
                                    error={!validator.fieldValid("name")}
                                    helperText={validator.getFieldErrorMessages("name")}
                                    />
                                {validator.addFieldRules("name", "required")}
                            </div>
                            <div>
                                 <TextField id="surname" name="surname" 
                                    required 
                                    label="Cognome" 
                                    variant="outlined" 
                                    value={values.surname}  
                                    onChange={handleChange("surname")}
                                    onBlur={handleBlur("surname")}
                                    error={!validator.fieldValid("surname")}
                                    helperText={validator.getFieldErrorMessages("surname")}
                                    />
                                 {validator.addFieldRules("surname", "required")}
                            </div>
                            
                        </Stack>
                        <Box sx={{ mt: 3 }} pr={3}>
                            <Accordion >
                                <AccordionSummary 
                                expandIcon={acordion_icon} 
                                aria-controls="panel1a-content" 
                                id="panel1a-header"
                                >
                                    <Typography>Dati</Typography>
                                </AccordionSummary>
                                <AccordionDetails>
                                  <TextField
                                    required
                                    fullWidth
                                    id="email"
                                    label="Email Address"
                                    name="email"
                                    value={values.email}
                                    autoComplete="email" 
                                    error={!validator.fieldValid("email")}
                                    helperText={validator.getFieldErrorMessages("email")}
                                    onChange={handleChange("email")}
                                    onBlur={handleBlur("email")}
                                  />
                                  {validator.addFieldRules("email", "required|email")}
                                </AccordionDetails>
                            </Accordion>
                        </Box>
                        <Stack direction="row" spacing={2}>
                            <div>
                                 <FormControlLabel control={<Checkbox defaultChecked name="status"/>} label="Attivo" />  
                            </div>
                        </Stack>
                        <Stack pt={3} pr={1} direction="row" spacing={2} style={{ display: "flex", justifyContent: "flex-end" }}>
                            <Button sx={{ border: "1px dashed grey" }} id = "id_button_1" type="submit">Save</Button>
                        </Stack>
                    </Box>
                             
                </FormControl>
            </Container>
        </React.Fragment>
    </div>     
  );
}


