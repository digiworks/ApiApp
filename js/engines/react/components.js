
function DatePickerInput({ openCalendar, value, handleValueChange }) {
  return (
    <TextField
      onFocus={openCalendar}
      value={value}
      onChange={handleValueChange}
    />
  )
}


function DataGridRest({restUrl, headers, keyColumn , columns, rowsPerPageInit = 5, rowsPerPageOptions = [5, 10, 25]}){
  const [page, setPage] = React.useState(0);
  const [rowsPerPage, setRowsPerPage] = React.useState(rowsPerPageInit);
  const [rows, setRows] = React.useState([]);
  const [totalElements, setTotalElements] = React.useState(0);
  

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
  
 let getData = async (page:number, size: number) => {
    
    let url = restUrl +
        `?per_page=`+ size +
        `&page=` + (page + 1);
    const response = await fetch(url);
    const result = await response.json();
    setTotalElements(result.totalCount);
    setRows(result.data);
  };
        
  React.useEffect(() => {
        getData(page, rowsPerPage);
  }, [page, rowsPerPage]);
  
  if(baseApp.isSsr()){
       getData(0, rowsPerPage);
  }
  
  return (
        <TableContainer component={Paper}>
            <Table sx={{ minWidth: 650 }} aria-label="simple table">
                 <TableHead>
                    <TableRow>
                        {( 
                           headers
                          ).map((row) => (
                        <TableCell>{row.text}</TableCell>
                        ))}
                    </TableRow>
                </TableHead>
                <TableBody>
                         {(
                           rows
                          ).map((row) => (
                          <TableRow
                            key={row["keyColumn"]}
                            sx={{ "&:last-child td, &:last-child th": { border: 0 } }}
                          >
                            {( 
                              columns
                            ).map((column) => (
                                <TableCell component="th" scope="row">
                                  {row[column.field]}
                                </TableCell>
                            ))}
                        </TableRow>
                    ))}
                </TableBody>
            </Table>
                <TablePagination
                    rowsPerPageOptions={rowsPerPageOptions}
                    component="div"
                    count={totalElements}
                    rowsPerPage={rowsPerPage}
                    page={page}
                    onPageChange={handleChangePage}
                    onRowsPerPageChange={handleChangeRowsPerPage}
                  />
                  </TableContainer>
            );
}

