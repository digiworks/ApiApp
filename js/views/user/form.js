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
    const handleChangeCheckBox = name => event => {
            setValues({...values, [name]: event.target.checked});
            validator.checkField(name, event.target.checked);
        };
        
    const handleBlur = name => event => {
            setValues({...values, [name]: event.target.value});
            validator.checkField(name, event.target.value);
        };
    const handleCancel = () => {
        setWaiting(true);
        let path = "/userslist";
        baseApp.redirect(path);
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
                                >
                                <TextField
                                    name="Id"
                                    type="hidden"
                                    value={values.Id}
                                    variant="standard"
                                    />
                                <Grid container spacing={2}>
                                    <Grid item xs={12}>
                                        <Box 
                                        display="flex"
                                        alignItems="center"
                                        >
                                            <Avatar alt="Remy Sharp" src={baseApp.urlStream("images/avatar/1.jpg")} sx={{ width: 128, height: 128 }} />
                                            <Button
                                                variant="contained"
                                                component="label"
                                                sx={{ml: 1}}
                                            >
                                            {baseApp.translations().t("upload_image", "userform")}
                                            <input
                                              type="file"
                                              hidden
                                            />
                                            </Button>
                                        </Box>
                                    </Grid>
                                    <Grid item xs={4}>
                                        <Box width={350}>
                                            <TextField id="Name" name="Name" 
                                                       label = {baseApp.translations().t("name", "userform")}
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
                                                       label={baseApp.translations().t("surname", "userform")} 
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
                                            <FormControlLabel control={ < Checkbox name = "Status" checked={Boolean(values.Status)} onChange={handleChangeCheckBox("Status")}/ > } label={baseApp.translations().t("Active", "userform")}/>  
                                        </div>
                                    </Grid>
                                    <Grid item xs={4}>
                                        <div>
                                            <TextField
                                                required
                                                fullWidth
                                                id="email"
                                                label={baseApp.translations().t("email", "userform")}
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
                                                label={baseApp.translations().t("description", "userform")}
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
                                            <Typography>{baseApp.translations().t("Permissions", "userform")}</Typography>
                                        </AccordionSummary>
                                        <AccordionDetails>
                                            <Grid container>
                                                <Grid item xs>
                                                  <FormControl sx={{ m: 1, minWidth: 120 }}>
                                                        <InputLabel id="groupid-label">{baseApp.translations().t("Group", "userform")}</InputLabel>
                                                        <Select
                                                            id="groupid"
                                                            labelId="groupid-label"
                                                            label={baseApp.translations().t("Group", "userform")}
                                                            value=""
                                                        >
                                                        <MenuItem value="">
                                                          <em>None</em>
                                                        </MenuItem>
                                                        <MenuItem value={10}>Twenty</MenuItem>
                                                        <MenuItem value={21}>Twenty one</MenuItem>
                                                        <MenuItem value={22}>Twenty one and a half</MenuItem>
                                                      </Select>
                                                  </FormControl>
                                                </Grid>
                                                <Divider orientation="vertical" flexItem>
                                                  {baseApp.translations().t("Roles", "userform")}
                                                </Divider>
                                                <Grid item xs>
                                                    <FormControl sx={{ m: 1, minWidth: 120 }}>
                                                    <Stack>
                                                        <FormControlLabel
                                                            control={
                                                              <Switch
                                                                
                                                                value="checked"
                                                                color="primary"
                                                              />
                                                            }
                                                            labelPlacement="start"
                                                            label={"Permesso"}
                                                        />
                                                        <FormControlLabel
                                                            control={
                                                              <Switch
                                                                
                                                                value="checked"
                                                                color="primary"
                                                              />
                                                            }
                                                            labelPlacement="start"
                                                            label={"Permesso"}
                                                        />
                                                        <FormControlLabel
                                                            control={
                                                              <Switch
                                                                
                                                                value="checked"
                                                                color="primary"
                                                              />
                                                            }
                                                            labelPlacement="start"
                                                            label={"Permesso"}
                                                        />
                                                    </Stack>
                                                    </FormControl>
                                                </Grid>
                                             </Grid>
                                            
                                        </AccordionDetails>
                                    </Accordion>
                                </Box>
                                
                                <Stack pt={3} pr={1} direction="row" spacing={2} style={{display: "flex", justifyContent: "flex-end"}}>
                                    <Button sx={{border: "1px dashed grey"}}  onMouseDown={handleCancel} id = "id_button_2" >{baseApp.translations().t("cancel", "userform")}</Button>
                                    <Button sx={{border: "1px dashed grey"}} id = "id_button_1" type="submit">{baseApp.translations().t("save", "userform")}</Button>
                                </Stack>
                            </Box>
            
                        </FormControl>
                    </Container>
                </React.Fragment>
            </div>
                    );
        }


