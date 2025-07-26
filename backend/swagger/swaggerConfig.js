const swaggerJSDoc = require("swagger-jsdoc");

const swaggerDefinition = {
  openapi: "3.0.0",
  info: {
    title: "StudySync API",
    version: "1.0.0",
    description: "API documentation for the StudySync app",
    contact: {
      name: "StudySync Team",
      email: "support@studysync.com",
    },
  },
  servers: [
    {
      url: "https://studysync-study-buddy-app.onrender.com/",
    },
    {
      url: "http://localhost:5000/",
    },
  ],
};

// Options for the swagger docs
const options = {
  swaggerDefinition,
  apis: ["./routes/routes.js", "./controllers/controllers.js"], // Files to be documented
};

// Initialize swagger-jsdoc
const swaggerSpec = swaggerJSDoc(options);

module.exports = swaggerSpec;
