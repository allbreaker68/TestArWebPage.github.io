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


const vars_env = ['echo $POINT_OF_ACCESS','echo $USER','echo $PASS'];

child.exec(vars_env[0],vars_env[1],vars_env[2],(error, stdout, stderr)=>{
    if (error) {
        throw error
    } if (stderr) {
        console.log(`stderr: ${stderr}`);
        return;
    }
    console.log(`stdout: ${stdout}`);
});