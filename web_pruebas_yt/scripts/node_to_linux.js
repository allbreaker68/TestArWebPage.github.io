import * as child from 'child_process';


/*
child.exec("ls -la", (error, stdout, stderr) => {
    if (error) {
        console.log(`error: ${error.message}`);
        return;
    }
    if (stderr) {
        console.log(`stderr: ${stderr}`);
        return;
    }
    console.log(`stdout: ${stdout}`);
});*/

function execute_commands() {
    const vars_env = ['POINT_OF_ACCESS','USER','PASS']; 
    for (let index = 0; index < vars_env.length; index++) {
        console.log(vars_env[index]);
        console.log('echo $'+vars_env[index])
    }
}

child.exec((error, stdout, stderr)=>{
    if (error) {
        throw error
    } else {
        execute_commands
    }
});