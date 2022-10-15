
const PORT_DEFAULT = 8000
const PORT_WS_DEFAULT = 6001

module.exports = function(args) {
    const port_numbers = args.map(arg => Number.parseInt(arg)).filter(arg => Number.isInteger(arg))

    if(port_numbers.length === 0) {
        port_numbers.push(PORT_DEFAULT)
        port_numbers.push(PORT_WS_DEFAULT)
    }

    return port_numbers
}