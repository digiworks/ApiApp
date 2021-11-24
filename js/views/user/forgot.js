function IndexPage() {
    
const handleSubmit = (event) => {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    
    console.log({
      email: data.get("email"),
    });
};
    return (
     <div>
         <React.Fragment>
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
               Forgot password
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
          </Box>
        </React.Fragment>
     </div>
    );
}


