if (typeof window === "undefined") {
    var ReactMultiDatePicker = global.ReactMultiDatePicker; 
}
const { DatePicker, Calendar } = ReactMultiDatePicker;

const months = [
  ["gem", "g"], //[["name","shortName"], ... ]
  ["feb", "f"],
  ["mar", "m"],
  ["apr", "a"],
  ["mag", "m"],
  ["giu", "g"],
  ["lug", "l"],
  ["ago", "a"],
  ["set", "s"],
  ["ott", "o"],
  ["nov", "n"],
  ["dic", "d"],
]
const weekDays = [
  ["dom", "s"], //[["name","shortName"], ... ]
  ["lun", "m"],
  ["mar", "t"],
  ["mer", "w"],
  ["gio", "t"],
  ["ven", "f"],
  ["sab", "s"],
]