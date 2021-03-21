# HarnessWebApp-demo
 A simple Web App to demo Harness with continuous Deployment and Verification


# Local Execution
## Build
`docker build -t ecointet/harness-webapp-demo .`
## Execute
`docker run -p 80:8000 ecointet/harness-webapp-demo`
GO to http://localhost

# Local Debug
`php -S 127.0.0.1:8080`
GO to http://localhost:8080