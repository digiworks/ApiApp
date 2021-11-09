
function DatePickerInput({ openCalendar, value, handleValueChange }) {
  return (
    <TextField
      onFocus={openCalendar}
      value={value}
      onChange={handleValueChange}
    />
  )
}


function DataGridRest({restUrl, 
                        headers, 
                        keyColumn , 
                        columns,
                        actions = [],
                        refresh = false,
                        rowsPerPageInit = 5, 
                        rowsPerPageOptions = [5, 10, 25, 50, 100, 150, 200, 300]
        }){
  const [page, setPage] = React.useState(0);
  const [rowsPerPage, setRowsPerPage] = React.useState(rowsPerPageInit);
  const [rows, setRows] = React.useState([]);
  const [totalElements, setTotalElements] = React.useState(0);
  
  const addAction = (action, indexRow, indexAction, rowData) => {
        return (
            <Button label={action.tooltip} onClick={(event) => {action.onClick(event,rowData);}} key={"bt" + indexRow.toString() + "_" + indexAction.toString()}>
                <Icon>{action.icon}</Icon>
                {action.text}
            </Button>
        );
  };
  
  const renderActions = (actions, indexRow, rowData) =>{
      if(actions.length){
        return (
            <TableCell align="right" key={"actions" + indexRow.toString()}>
                {( 
                  actions
                 ).map((action, index) => (
                   addAction(action, indexRow, index, rowData)
                  ))}
            </TableCell>
            );
      }
      return "";
  };
  
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
  
  React.useEffect(() => {
     if(refresh){
        getData(page, rowsPerPage);
    }
  }, [refresh]);
  
  return (
        <TableContainer component={Paper}>
            <Table sx={{ minWidth: 650 }} aria-label="simple table">
                 <TableHead>
                    <TableRow>
                        {( 
                           headers
                          ).map((row, index) => (
                        <TableCell component="th"  key={"th" + index.toString()}>{row.text}</TableCell>
                        ))}
                        {actions.length ? <TableCell component="th" align="right" key="thactions"></TableCell>: ""}
                    </TableRow>
                </TableHead>
                <TableBody>
                         {(
                           rows
                          ).map((row) => (
                          <TableRow
                            key={row[keyColumn]}
                            sx={{ "&:last-child td, &:last-child th": { border: 0 } }}
                          >
                            {( 
                              columns
                            ).map((column, index) => (
                                <TableCell component="td" scope="row" key={row[keyColumn] + index.toString()}>
                                  {row[column.field]}
                                </TableCell>
                            ))}
                            {renderActions(actions, row[keyColumn], row)}
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

