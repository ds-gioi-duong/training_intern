import React from 'react';
import logoSvg from '../../../../public/images/planet/mercury.svg';

export default function Mercury(props) {
    return <img src={logoSvg} alt="Logo" {...props} />;
}
