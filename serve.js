/*******************************************************
Ejecutar servidores de la app
- api
- websockets
- queue

Ejemplo:
npm run serve 8002 6003
 ******************************************************/

const {spawn} = require('child_process');
const port_numbers = require('./getPorts.js')(process.argv);
const runningInWindows = () => /^win/.test(process.platform);

// node kill-port
const killPort = spawn(runningInWindows() ? 'npx.cmd' : 'npx', ['kill-port', port_numbers.join(' ')], { stdio: 'inherit'});
killPort.on('error', (err) => {
    throw err;
});

killPort.on('exit', (code) => {
    setTimeout(() => {
        // php artisan websockets:restart
        const websockets_restart = spawn('php', ['artisan', 'websockets:restart'], { stdio: 'inherit'});
        websockets_restart.on('error', (err) => {
            throw err;
        });

        // php artisan websockets:serve
        const websockets_serve = spawn('php', ['artisan', 'websockets:serve', `--port=${port_numbers[1]}`], {stdio: 'inherit'});
        websockets_serve.on('error', (err) => {
            throw err;
        });

        // php artisan queue:restart
        const queue_restart = spawn('php', ['artisan', 'queue:restart'], {  stdio: 'inherit'});
        queue_restart.on('error', (err) => {
            throw err;
        });

        // php artisan queue:work
        const queue_work = spawn('php', ['artisan', 'queue:work'], { stdio: 'inherit'});
        queue_work.on('error', (err) => {
            throw err;
        });

        // php artisan serve
        const artisanServe = spawn('php', ['artisan', 'serve', `--port=${port_numbers[0]}`], {env:process.env, stdio: 'inherit'});
        artisanServe.on('error', (err) => {
            throw err;
        });

        console.log(`
====================================================
SERVICIOS ACTIVOS DE IMPRESIONES:
- Api [${ port_numbers[0] }]
- Websockets [${ port_numbers[1] }]
- Jobs
===================================================
`)

    }, 1000)
});



