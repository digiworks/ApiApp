

function createData(id,name, calories, fat, carbs, protein) {
  return {id, name, calories, fat, carbs, protein };
}

const rows = [
  createData(1,"Frozen yoghurt", 159, 6.0, 24, 4.0),
  createData(2,"Ice cream sandwich", 237, 9.0, 37, 4.3),
  createData(3,"Eclair", 262, 16.0, 24, 6.0),
  createData(4,"Cupcake", 305, 3.7, 67, 4.3),
  createData(5,"Gingerbread", 356, 16.0, 49, 3.9),
   createData(6,"Cupcake", 305, 3.7, 49, 3.9),
  createData(7,"Donut", 452, 25.0, 49, 3.9),
  createData(8,"Eclair", 262, 16.0, 49, 3.9),
  createData(9,"Frozen yoghurt", 159, 6.0, 49, 3.9),
  createData(10,"Gingerbread", 356, 16.0, 49, 3.9),
  createData(11,"Honeycomb", 408, 3.2, 49, 3.9),
  createData(12,"Ice cream sandwich", 237, 9.0, 49, 3.9),
  createData(13,"Jelly Bean", 375, 0.0, 49, 3.9),
  createData(14,"KitKat", 518, 26.0, 49, 3.9),
  createData(15,"Lollipop", 392, 0.2, 49, 3.9),
  createData(16,"Marshmallow", 318, 0, 49, 3.9),
  createData(17,"Nougat", 360, 19.0, 49, 3.9),
  createData(18,"Oreo", 437, 18.0, 49, 3.9),
];


function IndexPage() {
 
 const [page, setPage] = React.useState(0);
  const [rowsPerPage, setRowsPerPage] = React.useState(5);

  /* Avoid a layout jump when reaching the last page with empty rows.*/
  const emptyRows =
    page > 0 ? Math.max(0, (1 + page) * rowsPerPage - rows.length) : 0;

  const handleChangePage = (event, newPage) => {
    setPage(newPage);
  };

  const handleChangeRowsPerPage = (event) => {
    setRowsPerPage(parseInt(event.target.value, 10));
    setPage(0);
  };
  

  return (
           <div>
                <React.Fragment>
                <CssBaseline />
                <Container maxWidth="mm">
   
                <TableContainer component={Paper}>
                    <Table sx={{ minWidth: 650 }} aria-label="simple table">
                      <TableHead>
                        <TableRow>
                          <TableCell>Dessert (100g serving)</TableCell>
                          <TableCell align="right">Calories</TableCell>
                          <TableCell align="right">Fat&nbsp;(g)</TableCell>
                          <TableCell align="right">Carbs&nbsp;(g)</TableCell>
                          <TableCell align="right">Protein&nbsp;(g)</TableCell>
                        </TableRow>
                      </TableHead>
                      <TableBody>
                         {(rowsPerPage > 0
                            ? rows.slice(page * rowsPerPage, page * rowsPerPage + rowsPerPage)
                            : rows
                          ).map((row) => (
                          <TableRow
                            key={row.id}
                            sx={{ "&:last-child td, &:last-child th": { border: 0 } }}
                          >
                            <TableCell component="th" scope="row">
                              {row.name}
                            </TableCell>
                            <TableCell align="right">{row.calories}</TableCell>
                            <TableCell align="right">{row.fat}</TableCell>
                        <TableCell align="right">{row.carbs}</TableCell>
                        <TableCell align="right">{row.protein}</TableCell>
                        </TableRow>
                    ))}
                    </TableBody>
                </Table>
                <TablePagination
                    rowsPerPageOptions={[5, 10, 25]}
                    component="div"
                    count={rows.length}
                    rowsPerPage={rowsPerPage}
                    page={page}
                    onPageChange={handleChangePage}
                    onRowsPerPageChange={handleChangeRowsPerPage}
                  />
                  </TableContainer>
                </Container>
                </React.Fragment>
            </div>
  );
}