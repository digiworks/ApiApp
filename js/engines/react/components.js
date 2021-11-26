
function DatePickerInput({ openCalendar, value, handleValueChange }) {
  return (
    <TextField
      onFocus={openCalendar}
      value={value}
      onChange={handleValueChange}
    />
  )
}


const DataGridRestToolbar = (props) => {
  const { numSelected, title } = props;

  return (
    <Toolbar
      sx={{
        pl: { sm: 2 },
        pr: { xs: 1, sm: 1 },
        ...(numSelected > 0 && {
          bgcolor: (theme) =>
            alpha(theme.palette.primary.main, theme.palette.action.activatedOpacity),
        }),
      }}
    >
      {numSelected > 0 ? (
        <Typography
          sx={{ flex: "1 1 100%" }}
          color="inherit"
          variant="subtitle1"
          component="div"
        >
          {numSelected} selected
        </Typography>
      ) : (
        <Typography
          sx={{ flex: "1 1 100%" }}
          variant="h6"
          id="tableTitle"
          component="div"
        >
          {title}
        </Typography>
      )}

        
          <IconButton>
          <Icon>filter_list</Icon>
          </IconButton>
       
    </Toolbar>
  );
};

const  DataGridRestHead = ({
                            withSelectCheckBox = false,
                            onSelectAllClick, 
                            order = "asc", 
                            orderBy, 
                            numSelected = 0, 
                            rowCount, 
                            onRequestSort, 
                            headers = [],
                            actions = []
                        }) => {
  
  const createSortHandler = (property) => (event) => {
    onRequestSort(event, property);
  };
  
  const createSelectAlltHandler = (property) => (event) => {
    onSelectAllClick(event, property);
  };

  return (
    <TableHead>
      <TableRow>
      {(withSelectCheckBox ?
            <TableCell padding="checkbox">
              <Checkbox
                color="primary"
                indeterminate={numSelected > 0 && numSelected < rowCount}
                checked={rowCount > 0 && numSelected === rowCount}
                onChange={createSelectAlltHandler}
                inputProps={{
                  "aria-label": "select all desserts"
                }}
              /> 
            </TableCell>
        : null)}
        {(headers).map((headCell, index) => (
          <TableCell
            component="th"
            key={headCell.field}
            align={headCell.numeric ? "right" : "left"}
            padding={headCell.disablePadding ? "none" : "normal"}
            sortDirection={orderBy === headCell.field ? order : false}
          >
            <TableSortLabel
              active={orderBy === headCell.field}
              direction={orderBy === headCell.field ? order : "asc"}
              onClick={createSortHandler(headCell.field)}
            >
              {orderBy === headCell.field ? (
                <Tooltip title={order === "desc" ? "sorted descending" : "sorted ascending"}><span>{headCell.text}</span></Tooltip>
              ) : headCell.text}
            </TableSortLabel>
          </TableCell>
        ))}
        {actions.length ? <TableCell component="th" align="right" key="thactions"></TableCell> : null}
      </TableRow>
    </TableHead>
  );
};

function DataGridRest({
                        title = "Grid",
                        denseType = false,
                        restUrl, 
                        headers, 
                        keyColumn , 
                        columns,
                        actions = [],
                        refresh = false,
                        rowsPerPageInit = 5, 
                        rowsPerPageOptions = [5, 10, 25, 50, 100, 150, 200, 300],
                        orderByHeader = "",
                        orderDirection = "asc",
                        onRequestSort
        }){
  const [page, setPage] = React.useState(0);
  const [rowsPerPage, setRowsPerPage] = React.useState(rowsPerPageInit);
  const [rows, setRows] = React.useState([]);
  const [totalElements, setTotalElements] = React.useState(0);
  const [dense, setDense] = React.useState(denseType);
  
  const handleChangeDense = (event) => {
    setDense(event.target.checked);
  };
  
  const addAction = (action, indexRow, indexAction, rowData) => {
        return (
            <Tooltip title={action.tooltip} key={"tlp" + indexRow.toString() + "_" + indexAction.toString()}>
            <span>
                <Button label={action.tooltip} onClick={(event) => {action.onClick(event,rowData);}} key={"bt" + indexRow.toString() + "_" + indexAction.toString()}>
                    <Icon>{action.icon}</Icon>
                    {action.text}
                </Button>
            </span>
            </Tooltip>
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
  
 let getData = async (page: number, size: number, order: string, orderBy: string) => {
    
    let url = restUrl +
        `?per_page=`+ size +
        `&page=` + (page + 1) + 
        `&order=` + order + 
        `&orderBy=` + orderBy;
    const response = await fetch(url);
    const result = await response.json();
    setTotalElements(result.totalCount);
    setRows(result.data);
  };
        
  React.useEffect(() => {
        getData(page, rowsPerPage, orderDirection, orderByHeader);
  }, [page, rowsPerPage, orderDirection, orderByHeader ]);
  
  React.useEffect(() => {
     if(refresh){
        getData(page, rowsPerPage, orderDirection, orderByHeader);
    }
  }, [refresh]);
  
  return (
        <TableContainer component={Paper}>
            <DataGridRestToolbar title={title} />
            <Table sx={{ minWidth: 650 }} aria-label="simple table" size={dense ? "small" : "medium"}>
                <DataGridRestHead 
                    headers = {headers} 
                    actions = {actions}
                    order={orderDirection}
                    orderBy={orderByHeader}
                    onRequestSort={onRequestSort}
                />
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
                                  { (typeof column.field !== "function") ? row[column.field] : column.field(row)}
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
            <FormControlLabel
                sx={{pl:3}}
                control={<Switch checked={dense} onChange={handleChangeDense} />}
                label="Dense padding"
            />
        </TableContainer>
    );
}

