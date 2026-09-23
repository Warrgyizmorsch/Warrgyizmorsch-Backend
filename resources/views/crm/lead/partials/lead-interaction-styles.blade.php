    /* Modern Activity & History Offcanvas Styles */
    .cm-segmented-pills {
        background: #f1f5f9;
        padding: 4px;
        border-radius: 10px;
    }
    .cm-segmented-pills .cm-tab-btn {
        border: none !important;
        color: #64748b !important;
        background: transparent !important;
        border-radius: 8px !important;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: none !important;
    }
    .cm-segmented-pills .cm-tab-btn.active {
        background: #ffffff !important;
        color: #0f172a !important;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08), 0 1px 2px rgba(15, 23, 42, 0.04) !important;
    }
    .cm-segmented-pills .cm-tab-btn.active #cm_badge_comments_count,
    .cm-segmented-pills .cm-tab-btn.active #cm_badge_status_count,
    .cm-segmented-pills .cm-tab-btn.active #cm_badge_events_count {
        background: #006FC9 !important;
        color: #ffffff !important;
    }

    .comment-history-summary,
    .cm-history-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        margin-bottom: 14px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03);
    }

    /* Vertical Spine Timeline */
    .comment-timeline,
    .cm-timeline {
        position: relative;
        padding-left: 28px;
    }
    .comment-timeline::before,
    .cm-timeline::before {
        content: '';
        position: absolute;
        top: 14px;
        bottom: 14px;
        left: 11px;
        width: 2px;
        background: #e2e8f0;
    }
    .comment-timeline-item,
    .cm-timeline-item {
        position: relative;
        padding-bottom: 16px;
    }
    .comment-timeline-item:last-child,
    .cm-timeline-item:last-child {
        padding-bottom: 0;
    }
    .comment-timeline-dot,
    .cm-timeline-node {
        position: absolute;
        top: 12px;
        left: -28px;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #006FC9;
        color: #006FC9;
        box-shadow: 0 0 0 3px rgba(0, 111, 201, 0.12);
        z-index: 2;
        font-size: 11px;
        transition: transform 0.15s ease;
    }
    .cm-timeline-item:hover .cm-timeline-node {
        transform: scale(1.1);
    }
    .cm-timeline-node.node-call {
        border-color: #0284c7;
        background: #f0f9ff;
        color: #0284c7;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
    }
    .cm-timeline-node.node-note {
        border-color: #f59e0b;
        background: #fffbeb;
        color: #d97706;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
    }
    .cm-timeline-node.node-status {
        border-color: #8b5cf6;
        background: #f5f3ff;
        color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
    }

    /* Timeline Cards */
    .comment-history-card,
    .cm-card {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04), 0 1px 2px rgba(15, 23, 42, 0.02);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .comment-history-card:hover,
    .cm-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.07);
        transform: translateY(-1px);
    }

    .comment-history-meta,
    .cm-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 10px 14px;
        border-bottom: 1px solid #f1f5f9;
        background: #fafbfc;
    }

    .cm-user-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        overflow: hidden;
    }
    .cm-user-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        flex-shrink: 0;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .comment-history-content,
    .cm-card-body {
        padding: 12px 14px;
    }

    .comment-message-box,
    .cm-message-box {
        padding: 9px 12px;
        border-left: 3px solid #006FC9;
        border-radius: 0 8px 8px 0;
        background: #f8fafc;
        color: #1e293b;
        font-size: 12.5px;
        line-height: 1.55;
        white-space: pre-wrap;
        word-break: break-word;
        font-weight: 450;
    }

    /* Micro Badges & Chips */
    .cm-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.3;
        transition: background 0.15s ease;
    }
    .cm-chip-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
        background: currentColor;
    }
    .cm-chip.chip-type {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
    }
    .cm-chip.chip-danger {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .cm-chip.chip-success {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }
    .cm-chip.chip-info {
        background: #f0f9ff;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }
    .cm-chip.chip-next {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fef3c7;
    }
    .cm-doc-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 8px;
        border-radius: 6px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #1e293b;
        text-decoration: none;
        font-size: 11px;
        font-weight: 500;
        transition: all 0.15s ease;
    }
    .cm-doc-chip:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #1d4ed8;
    }

    /* Modern Status Transition Box & Narrative */
    .cm-status-narrative {
        font-size: 12.5px;
        line-height: 1.55;
        color: #334155;
    }
    .cm-status-transition-box {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        padding: 8px 12px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }
    .cm-status-pill-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 9px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.2px;
    }
    .cm-status-pill-badge.status-from {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }
    .cm-status-pill-badge.status-to {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .cm-status-pill-badge.status-same {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }
    .cm-status-note-box {
        padding: 7px 10px;
        background: #fdfefe;
        border: 1px dashed #cbd5e1;
        border-radius: 6px;
        font-size: 12px;
        color: #334155;
    }

