import 'bootstrap/dist/css/bootstrap.min.css';
import '../styles/globals.css'
import Navigation from "../components/Navigation";

function MyApp({Component, pageProps}) {
    return (
        <div className="row">
            <div className="col-md-8 mx-auto">
                <Navigation/>
                <Component {...pageProps} />
            </div>
        </div>
    );
}

export default MyApp
