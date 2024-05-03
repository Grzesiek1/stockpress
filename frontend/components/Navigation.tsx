import {Navbar, Nav, Container} from 'react-bootstrap';
import Link from 'next/link';
import {t} from "../i18n";

const Navigation = () => {
    return (
        <Navbar bg="light" expand="lg">
            <Container>
                <Navbar.Collapse id="basic-navbar-nav" className="justify-content-center">
                    <Nav>
                        <Link href="/file-add">
                            <a className="nav-link">{t('Add file')}</a>
                        </Link>
                        <Link href="/files-view">
                            <a className="nav-link">{t('View files')}</a>
                        </Link>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
}

export default Navigation;