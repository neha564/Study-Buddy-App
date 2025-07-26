const express = require("express");
const bodyParser = require("body-parser");
const connectDB = require("./config/db");
const routes = require("./routes/routes");
const cors = require("cors");
const swaggerUi = require("swagger-ui-express");
const swaggerSpec = require("./swagger/swaggerConfig");

// Load environment variables at the start
require("dotenv").config();

// Connect to MongoDB
connectDB();

const app = express();
app.use(bodyParser.json());

// Apply CORS middleware before defining routes
app.use(cors({ origin: "*" }));

// Redirect from '/' to '/api-docs'
app.get("/", (req, res) => {
  res.redirect("/api-docs");
});

// Define Swagger UI route with custom title
const options = {
  customCss: `
    .swagger-ui .topbar { background-color: #3949ab; }
    .swagger-ui .topbar-wrapper .link { color: white !important; }
  `,
  customSiteTitle: "StudySync API Documentation", // Custom Title for Browser Tab
};

// Define Swagger UI route with custom setup
app.use("/api-docs", swaggerUi.serve, swaggerUi.setup(swaggerSpec, options));

// Define routes
app.use("/api", routes);

// Start the server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
