    
class IndexPage extends React.Component {
    
    constructor(props) {
        super(props);
        this.state = { liked: false };
        this.top100Films = [{ label: "The Shawshank Redemption", year: 1994 },
                    { label: "The Godfather", year: 1972 },
                    { label: "The Godfather: Part II", year: 1974 },
                    { label: "The Dark Knight", year: 2008 },
                    { label: "12 Angry Men", year: 1957 },
                    { label: "Schindler's List", year: 1993 },
                    { label: "Pulp Fiction", year: 1994 }
                    ];
         this.updateInputValue = this.updateInputValue.bind(this);
         
      }
    getInitialState() {
        return {
          inputValue: "30"
        };
      } 
    updateInputValue(evt) {
        this.setState({
          inputValue: evt.target.value
        });
      }
    submit(e){
        e.preventDefault();
        alert("it works!");
        let path = `/`;
        redirect(path);
      }
    gotlistuser(e)
    {
        e.preventDefault();
      let path = "/listuser";
      redirect(path);
    }
    render() {
        
        
        var defa = "30";
        if(typeof window != "undefined"){
            const windowUrl = window.location.search;
            const qparams = new URLSearchParams(windowUrl);
            if(!!qparams.get("age"))
            {
                defa = qparams.get("age");
            }
        }else
        {
            if(typeof queryStringValues["age"] !== "undefined"){
                defa = queryStringValues["age"];
            }
        }
        return(
                
           <div>
            <React.Fragment>
                <CssBaseline />
                <Container maxWidth="sm">
                    <FormControl fullWidth>
                        <Box>
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
                                    <Autocomplete
                                        disablePortal
                                        id="combo-box-demo"
                                        options={this.top100Films}
                                        sx={{ width: 300 }}
                                        renderInput={(params) => <TextField {...params} label="Movie" />}
                                      />
                                     <NativeSelect
                                        value ={this.state.inputValue}
                                        defaultValue={defa}
                                        inputProps={{
                                          name: "age",
                                          id: "uncontrolled-native"
                                        }}
                                        onChange={this.updateInputValue}
                                      >
                                        <option value={10}>Ten</option>
                                        <option value={20}>Twenty</option>
                                        <option value={30}>Thirty</option>
                                      </NativeSelect>
                                    <Button id = "id_button_1" type="submit">Save</Button>

                                   <Slider
                                    size="small"
                                    defaultValue={70}
                                    aria-label="Small"
                                    valueLabelDisplay="auto"
                                  />
                                  <Slider defaultValue={50} aria-label="Default" valueLabelDisplay="auto" />

                                </Box>

                                <Box sx={{ borderBottom: 1, borderColor: "divider" }}>
                                 <Tabs value={1} aria-label="basic tabs example">
                                    <Tab value={1} label="Item One" />
                                    <Tab value={2} label="Item Two" />
                                    <Tab value={3} label="Item Three" />
                                 </Tabs>

                                </Box>

                            </Box>
                        </FormControl>
                        
                        <Box
                        sx={{
                          display: "flex",
                          flexWrap: "wrap",
                          "& > :not(style)": {
                            m: 1,
                            width: 128,
                            height: 128,
                          }
                        }}
                      >
                        <Paper elevation={0} />
                        <Paper />
                        <Paper elevation={3} />
                      </Box>
                      <Stack direction="row" spacing={1}>
                        <Chip label="Chip Filled" />
                        <Chip label="Chip Outlined" variant="outlined" />
                      </Stack>
                      <Stack direction="row" spacing={2}>
                        <Avatar alt="Remy Sharp" src="/static/images/avatar/1.jpg" />
                        <Avatar alt="Travis Howard" src="/static/images/avatar/2.jpg" />
                        <Avatar alt="Cindy Baker" src="/static/images/avatar/3.jpg" />
                      </Stack>
                       
                       <Button sx={{ border: "1px dashed grey" }} id = "id_button_1" onClick={this.gotlistuser}>ListUser</Button>
                      
            </Container>

                </React.Fragment>
            </div>
                );
    }
  }