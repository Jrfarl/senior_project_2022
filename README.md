# Senior Project 2022




# Building from git
It is very easy to install this application on **Ubuntu 22.04**. 
We assume that you have already set up the ubuntu environment and have sudo access. We will not be going over how to configure the operating system.

To being, you will need to install git. This can be completed by performing the following steps

 - sudo apt-get update && apt-get upgrade -y
 - apt-get install git –y

After the completion of the above commands, go ahead and clone the repository.

 - git clone [https://github.com/harman127/senior_project_2022.git](https://github.com/harman127/senior_project_2022.git)

To install all requirements and configure the application automatically perform the following three steps.

 - cd senior_project_2022
	
 - chmod +x install.sh
 - ./install.sh

Thats it! You can now go to the ip address assigned to the machine. Apache will automatically assume that it is broadcasting on all interfaces.



