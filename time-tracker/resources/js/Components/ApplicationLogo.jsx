import React from 'react';
import logoSvg from '../../../public/images/logo.svg';

export default function ApplicationLogo(props) {
    return <img src={logoSvg} alt="Logo" {...props} />;
}
