function IndexPage() {
    var id_field = "id";

    const [values, setValues] = React.useState({
        Id: "",
        Name: "",
        surname: "",
        email: "",
        description: "",
        CreatedAt: null,
        CreatedBy: null,
        DeletedAt: null,
        DeletedBy: null,
        Status: 0,
        UpdatedAt: null,
        UpdatedBy: null,
        hash: null
    });
    const validator = baseApp.formValidator();
    const [error, setError] = React.useState(false);
    const [waiting, setWaiting] = React.useState(false);
    const [emailerror, setEmailError] = React.useState(false);

    baseApp.translations().loadResourceBundle("en", 'userform', {
        name: "Nome del soggetto",
    }, true, true);
    const getModel = async (id) => {
        var data = {
            "Id": id
        };
        var model = [];
        var result = await baseApp.fetch("/api/user/get", data);
        if (result.status == "success") {
            if (result.message['message'] == "found") {
                model = result.message['model'];
            }
        } else {
            if (result.status == "error")
            {

            }
        }
        return model;
    };

    const submit = async (e) => {
        e.preventDefault();
        const formValid = validator.allValid();
        /*console.log(formValid);
         debugger;*/
        if (formValid) {
            validator.hideMessages();
            setWaiting(true);
            const data = new FormData(e.currentTarget);
            var result = await baseApp.fetch("/api/user/save", baseApp.formDataToObject(data));
            if (result.status == "success") {
                let path = "/userslist";
                baseApp.redirect(path);
            } else {
                if (result.status == "error")
                {
                    setError(true);
                    setWaiting(false);
                }
            }
        } else {
            validator.showMessages();
        }
    };
    React.useEffect(() => {
        var id_value = null;
        if (baseApp.isWeb()) {
            const qparams = baseApp.queryString();
            if (qparams.get(id_field))
            {
                id_value = qparams.get(id_field);
                getModel(id_value).then(function (model) {
                    model["email"] = "digiw@gmail.com"; /*for prevent all values need */
                    setValues(model);
                });
            }
        } else
        {
            if (typeof queryStringValues[id_field] !== "undefined") {
                id_value = queryStringValues[id_field];
            }
        }
    }, []);

    const acordion_icon = <Icon>expand_more</Icon>;

    const handleChange = name => event => {
            setValues({...values, [name]: event.target.value});
            validator.checkField(name, event.target.value);
        };
    const handleBlur = name => event => {
            setValues({...values, [name]: event.target.value});
            validator.checkField(name, event.target.value);
        };

    return (
            <div>
                <React.Fragment>
                    <CssBaseline />
                    <Backdrop
                        sx={{color: "#fff", zIndex: (theme) => theme.zIndex.drawer + 1}}
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
                                    onClick={() => {setError(false);}
                                    }
                        >
                     <Icon fontSize="inherit">close</Icon>
                     </IconButton>
                                }
                                sx={{mb: 2}}
                                >
                                Errore durante il salvataggio!
                            </Alert>
                        </Collapse>
                        <FormControl fullWidth>
                            <Box 
                                pt={3}
                                pl={1}
                                pb={3}
                                method="post"
                                onSubmit={submit}
                                component="form"
                                autoComplete="off"
                                sx={{bgcolor: "#cfe8fc"}}
                                >
                                <TextField
                                    name="Id"
                                    type="hidden"
                                    value={values.Id}
                                    variant="standard"
                                    />
                                <Grid container spacing={2}>
                                    <Grid item xs={4}>
                                        <Box width={350}>
                                            <TextField id="Name" name="Name" 
                                                       label = {baseApp.translations().t("Name", "userform")}
                                                       required 
                                                       variant="outlined" 
                                                       value={values.Name}  
                                                       onChange={handleChange("Name")}
                                                       onBlur={handleBlur("Name")}
                                                       error={!validator.fieldValid("Name")}
                                                       helperText={validator.getFieldErrorMessages("Name")}
                                                       fullWidth
                                                       />
                                            {validator.addFieldRules("Name", "required")}
                                            </Box>
                                    </Grid>
                                    <Grid item xs={4}>
                                        <Box width={350}>
                                            <TextField id="surname" name="surname" 
                                                       required 
                                                       label={baseApp.translations().t("Surname", "userform")} 
                                                       variant="outlined" 
                                                       value={values.surname}  
                                                       onChange={handleChange("surname")}
                                                       onBlur={handleBlur("surname")}
                                                       error={!validator.fieldValid("surname")}
                                                       helperText={validator.getFieldErrorMessages("surname")}
                                                       fullWidth
                                                       />
                                            {validator.addFieldRules("surname", "required")}
                                        </Box>
                                    </Grid>
                                    <Grid item xs={2}>
                                        <div>
                                            <FormControlLabel control={ < Checkbox name = "status" checked={Boolean(values.Status)} / > } label={baseApp.translations().t("Active", "userform")}/>  
                                        </div>
                                    </Grid>
                                    <Grid item xs={4}>
                                        <div>
                                            <TextField
                                                required
                                                fullWidth
                                                id="email"
                                                label={baseApp.translations().t("Email Address", "userform")}
                                                name="email"
                                                value={values.email}
                                                autoComplete="email" 
                                                error={!validator.fieldValid("email")}
                                                helperText={validator.getFieldErrorMessages("email")}
                                                onChange={handleChange("email")}
                                                onBlur={handleBlur("email")}
                                                />
                                            {validator.addFieldRules("email", "required|email")} 
                                        </div>
                                    </Grid>
                                    <Grid item xs={8} pr={3}>
                                        <div>
                                            <TextField
                                                multiline
                                                maxRows={4}
                                                id="description"
                                                label={baseApp.translations().t("Description", "userform")}
                                                name="description"
                                                value={values.description}
                                                autoComplete="description" 
                                                error={!validator.fieldValid("description")}
                                                helperText={validator.getFieldErrorMessages("description")}
                                                onChange={handleChange("description")}
                                                onBlur={handleBlur("description")}
                                                fullWidth
                                                />
                                        </div>
                                    </Grid>
                                </Grid>
                                <Box sx={{mt: 3}} pr={3}>
                                    <Accordion >
                                        <AccordionSummary 
                                            expandIcon={acordion_icon} 
                                            aria-controls="panel1a-content" 
                                            id="panel1a-header"
                                            >
                                            <Typography>Dati</Typography>
                                        </AccordionSummary>
                                        <AccordionDetails>
                                            
                                        </AccordionDetails>
                                    </Accordion>
                                </Box>
                                
                                <Stack pt={3} pr={1} direction="row" spacing={2} style={{display: "flex", justifyContent: "flex-end"}}>
                                    <Button sx={{border: "1px dashed grey"}} id = "id_button_1" type="submit">Save</Button>
                                </Stack>
                            </Box>
            
                        </FormControl>
                    </Container>
                </React.Fragment>
            </div>
                    );
        }


