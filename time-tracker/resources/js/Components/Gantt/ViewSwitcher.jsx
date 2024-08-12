import "gantt-task-react/dist/index.css"

import React from "react"
import { ViewMode } from "gantt-task-react"

export const ViewSwitcher = ({ onViewModeChange, onViewListChange, isChecked }) => {
  return (
    <div className='ViewContainer'>
      <button className='Button' onClick={() => onViewModeChange(ViewMode.Hour)}>
      時間
      </button>
      <button className='Button' onClick={() => onViewModeChange(ViewMode.QuarterDay)}>
      1/4日
      </button>
      <button className='Button' onClick={() => onViewModeChange(ViewMode.HalfDay)}>
      半日
      </button>
      <button className='Button' onClick={() => onViewModeChange(ViewMode.Day)}>
      1日
      </button>
      <button className='Button' onClick={() => onViewModeChange(ViewMode.Week)}>
      1週間
      </button>
      <button className='Button' onClick={() => onViewModeChange(ViewMode.Month)}>
      1か月
      </button>

      <div className='Switch'>
        <label className='Switch_Toggle'>
          <input
            type='checkbox'
            defaultChecked={isChecked}
            onClick={() => onViewListChange(!isChecked)}
          />
          <span className='Slider' />
        </label>
        タクスリストを表示
      </div>
    </div>
  )
}
