
if (typeof window === "undefined") {
    var React = global.React, ReactDOM = global.ReactDOM, ReactDOMServer = global.ReactDOMServer; 
    React.useLayoutEffect = React.useEffect;
}

function redirect(goto){
    if (goto != '') {
        window.location = goto;
    }
}

 
// MUI Define
const {
        Accordion,
        AccordionDetails,
        AccordionSummary,
        Alert,
        AppBar,
        Avatar,
        Autocomplete,
        Badge,
        Backdrop,
        Box,
        Breadcrumbs,
        Button,
        BottomNavigation,
        Checkbox,
        CircularProgress,
        Collapse,
        Container,
        DataGrid,
        Dialog,
        DialogTitle,
        DialogContent,
        DialogContentText,
        DialogActions,
        Divider,
        Drawer,
        FormControl,
        FormControlLabel,
        Link,
        Hidden,
        Grid,
        Menu,
        MenuItem,
        Modal,
        NativeSelect,
        NoSsr,
        SpeedDial,
        SpeedDialAction,
        Stepper,
        Table,
        TableBody,
        TableCell,
        TableContainer,
        TableHead,
        TableRow,
        TablePagination,
        TableSortLabel,
        Tabs,
        Tab,
        TabContext,
        TextField,
        Toolbar,
        Select,
        Stack,
        VolumeDown,
        Slider,
        VolumeUp,
        TabPanel,
        CssBaseline,
        FormLabel,
        Tooltip,
        IconButton,
        Paper,
        Chip,
        ToggleButton,
        ToggleButtonGroup,
        Icon,
        MaterialIcons,
        List,
        ListItem,
        ListItemButton,
        ListItemIcon,
        ListItemText,
        ListItemAvatar,
        ListSubheader,
        Typography,
        SvgIcon,
        Popover,
        Switch
    } = MaterialUI;


const { styled, createTheme, ThemeProvider } = MaterialUI;