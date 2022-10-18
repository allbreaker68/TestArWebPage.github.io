import * as child from 'child_process';


const vars_env = ['echo $POINT_OF_ACCESS', 'echo $USER', 'echo $PASS', 'echo $AWS_SECRET_ACCESS_KEY', 'echo $AWS_ACCESS_KEY_ID'];

const vars_to_node = [];

for (let i = 0; i < 5; i++) {
    

    child.exec(vars_env[i], (error, stdout, stderr) => {
        if (error) {
            throw error
        } if (stderr) {
          //console.log(`stderr: ${stderr}`);
            return;
        }
       //console.log(`stdout: ${stdout}`);
        vars_to_node[i] = `${stdout}`;

    });
}

async function consolevars() {
    for (let i = 0; i < vars_env.length; i++) {
        console.log("var in code " + vars_to_node[i]);
    }
}
setTimeout(() => { 
    consolevars(); 
    
}, 500)

export{
    vars_to_node
}