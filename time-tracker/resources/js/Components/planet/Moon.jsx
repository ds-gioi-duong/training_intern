import React from 'react';
import logoSvg from '../../../../public/images/planet/moon.svg';

export default function Moon(props) {
    return <img src={logoSvg} alt="Logo" {...props} />;
}
