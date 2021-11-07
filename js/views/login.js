
class IndexPage extends React.Component {
    
    constructor(props) {
        super(props);
        this.state = { liked: false };
       
      }
   submit(e){
    e.preventDefault();
    alert("it works!");
    let path = "/login";
    redirect(path);
  }
    render() {
        /*dateFns.format(new Date(), "'Today is a' eeee");*/
        return(
                <div>
            <React.Fragment>
                <CssBaseline />
                <Container maxWidth="sm">
                        <FormControl fullWidth>
                            <Box 
                            pt={3}
                            pl={1}
                            action="/login"
                            method="post"
                            onSubmit={this.submit}
                            component="form"
                            autoComplete="off"
                            sx={{ bgcolor: "#cfe8fc", height: "50vh" }}
                            >
                                <Stack direction="row" spacing={2}>
                                    <div>
                                        <TextField id="user" required label="Username" variant="outlined" />
                                    </div>
                                    <div>
                                            <TextField
                                                required
                                                id="password"
                                                label="Password"
                                                type="password"
                                                autoComplete="current-password"
                                                variant="outlined"
                                              />
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
  }

