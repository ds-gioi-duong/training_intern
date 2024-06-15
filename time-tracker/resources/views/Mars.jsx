import React from 'react';
import logoSvg from '../../../../public/images/planet/mars.svg';

export default function Mars(props) {
    return <img src={logoSvg} alt="Logo" {...props} />;
}
