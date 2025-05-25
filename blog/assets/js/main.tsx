import ReactDOM from "react-dom/client";
import "../css/tailwind-output.min.css";
import MainVisualCarousel from "./mainVisualCarousel";

export const BASE_URL = (window as any).APP_CONFIG.BASE_URL;

const mainVisual = document.getElementById("main-visual");
if (mainVisual) ReactDOM.createRoot(mainVisual).render(<MainVisualCarousel />);
