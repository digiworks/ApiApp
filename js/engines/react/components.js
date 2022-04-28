
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
  const { numSelected, title, filterFields, onRequestFilter } = props;
  const acordion_icon = <Icon>filter_list</Icon>;
  const [originFilterFields, setOriginFilterFields] = React.useState(filterFields.map(obj => ({...obj})));
  const [orAndSwith, setOrAndSwith] = React.useState(false);
  const [beginInsideSwith, setBeginInsideSwith] = React.useState(false);
  
   const handleClearFilter = (event) => {
        filterFields.map((elem, index) => {
          elem.value = originFilterFields[index].value;
          document.getElementById(elem.id).value = originFilterFields[index].value;
      });
      
  };
  
  const handleFilterChange = id => event => {
        filterFields[id].value = event.target.value;
    };
    
  const createFilterHandler = (event) => {
    onRequestFilter(event);
  };
        
  const handleOrAndChange = event => {
    setOrAndSwith (event.target.checked);
  };
  
   const handleBeginInsideChange = event => {
    setBeginInsideSwith (event.target.checked);
  };
  
  return (
    <Toolbar
      sx={{
        pb: { sm: 3 },
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
          sx={{ flex: "1 1 30%" }}
          color="inherit"
          variant="subtitle1"
          component="div"
        >
          {numSelected} selected
        </Typography>
      ) : (
        <Typography
          sx={{ flex: "1 1 30%" }}
          variant="h6"
          id="tableTitle"
          component="div"
        >
          {title}
        </Typography>
      )}
      { filterFields.length  > 0 ? (
        <Box sx={{mt: 3, flex: "1 1 100%"}} pr={3}>
            <Accordion><AccordionSummary expandIcon={acordion_icon} aria-controls="panel1a-content" id="panel1a-header"> 
                    <Typography>Filter</Typography>
                </AccordionSummary>
                <AccordionDetails>
                    <Grid container spacing={2} key="filter_grid">
                    {(filterFields).map((headCell, index) => (
                        <Grid item xs={4}  key={headCell.field}>
                            {(function () {
                                switch (headCell.type) {
                                    case 'text':
                                        return (<TextField id={headCell.id} label={headCell.label} variant="outlined"  onChange={handleFilterChange(index)}/>);
                                        break;
                                }
                            })()}
                        </Grid>
                        ))}
                    </Grid>
                    <Stack pt={3} pr={1} direction="row" spacing={2} style={{display: "flex", justifyContent: "flex-end"}}>
                        <Button sx={{border: "1px dashed grey"}} id = "id_button_0" onClick ={handleClearFilter}>{baseApp.translations().t("Clear", "datagridrest")}</Button>
                        <Button sx={{border: "1px dashed grey"}} id = "id_button_1" onClick ={createFilterHandler}>{baseApp.translations().t("Filter", "datagridrest")}</Button>
                    </Stack>
                    <FormControlLabel
                        control={
                          <Switch
                            checked={orAndSwith}
                            onChange={handleOrAndChange}
                            value="checked"
                            color="primary"
                          />
                        }
                        labelPlacement="start"
                        label={orAndSwith ? "And" : "Or"}
                      />
                      <FormControlLabel
                        control={
                          <Switch
                            checked={beginInsideSwith}
                            onChange={handleBeginInsideChange}
                            value="checked"
                            color="primary"
                          />
                        }
                        labelPlacement="start"
                        label={beginInsideSwith ? "Inside" : "Begin with"}
                      />
                </AccordionDetails>
            </Accordion>
        </Box>
        ) : null}
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
                        filterFields = [],
                        refresh = false,
                        rowsPerPageInit = 5, 
                        rowsPerPageOptions = [5, 10, 25, 50, 100, 150, 200, 300],
                        orderByHeader = "",
                        orderDirection = "asc"
        }){
  const [page, setPage] = React.useState(0);
  const [rowsPerPage, setRowsPerPage] = React.useState(rowsPerPageInit);
  const [rows, setRows] = React.useState([]);
  const [totalElements, setTotalElements] = React.useState(0);
  const [dense, setDense] = React.useState(denseType);
  const [order, setOrder] = React.useState(orderDirection);
  const [orderBy, setOrderBy] = React.useState(orderByHeader);
  const [filters, setFilters] = React.useState(filterFields);
  const [waiting, setWaiting] = React.useState(false);
  
  
  const handleRequestFilter = (event) => {
      getData(page, rowsPerPage, order, orderBy);
      setPage(0);
  };
  
  const handleRequestSort = (event, property) => {
    const isAsc = orderBy === property && order === 'asc';
    setOrder(isAsc ? 'desc' : 'asc');
    setOrderBy(property);
  };
  
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
    
    setWaiting(true);
    var filtersValues = [];
    if(filters.length){
        filters.map((elem) => {filtersValues.push({['field']: elem.field, ['value']:elem.value})});
    }
    let url = restUrl +
        `?per_page=`+ size +
        `&page=` + (page + 1) + 
        `&order=` + order + 
        `&orderBy=` + orderBy +
        `&filter=` + JSON.stringify(filtersValues);
    const response = await baseApp.getFetch(url);
    const result = await response.message;
    
    setTotalElements(result.totalCount);
    setRows(result.data);
    setWaiting(false);
  };
        
  React.useEffect(() => {
        getData(page, rowsPerPage, order, orderBy);
  }, [page, rowsPerPage, order, orderBy ]);
  
  React.useEffect(() => {
     if(refresh){
        getData(page, rowsPerPage, order, orderBy);
    }
  }, [refresh]);
  
  return (
        <TableContainer component={Paper}>
            <Backdrop
                sx={{color: "#fff", zIndex: (theme) => theme.zIndex.drawer + 1}}
                open={waiting}
                >
                <CircularProgress color="success"/>
            </Backdrop>
            <DataGridRestToolbar title={title} filterFields={filterFields} onRequestFilter = {handleRequestFilter}/>
            <Table sx={{ minWidth: 650 }} aria-label="simple table" size={dense ? "small" : "medium"}>
                <DataGridRestHead 
                    headers = {headers} 
                    actions = {actions}
                    order={order}
                    orderBy={orderBy}
                    onRequestSort={handleRequestSort}
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

