import React from 'react';
import logoSvg from '../../../../public/images/planet/sun.svg';

export default function Sun(props) {
    return <img src={logoSvg} alt="Logo" {...props} />;
}
