SELECT SQL_CALC_FOUND_ROWS P.id ,
 P.id AS student,
 P.firstname,
 P.lastname,
 P.risk_level,
 RL.risk_text,
 RL.image_name,
 IL.text AS intent_to_leave_text,
 IL.image_name AS intent_to_leave_image,
 RML.risk_model_id,
 (select
		(case 
			when (activity_type='N') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Note')
			when (activity_type='A') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Appointment')
			when (activity_type='C') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Contact')
			when (activity_type='E') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Email')
			when (activity_type='R') then concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Referral')
			else concat(DATE_FORMAT(activity_date,'%m/%d/%y'), ' - ','Login')
		END) as new
        from activity_log aal where aal.id =  max(acl.id) AND acl.deleted_at is null
) as last_activity ,
 OPS.surveycohort AS student_cohort, 
 count(acl.id) as cnt, 
 OPS.status, 
 OPS.photo_url,
 pem.metadata_value as class_level 
FROM person P 
LEFT JOIN  risk_level AS RL ON P.risk_level = RL.id 
LEFT JOIN risk_model_levels AS RML ON RML.risk_level = RL.id 
LEFT JOIN intent_to_leave AS IL ON P.intent_to_leave = IL.id
LEFT JOIN org_person_student AS OPS ON OPS.person_id = P.id 
LEFT JOIN activity_log acl on (acl.person_id_student = P.id) 
LEFT JOIN person_ebi_metadata as pem on (pem.person_id = P.id and pem.ebi_metadata_id IN ( Select id from ebi_metadata where meta_key ="ClassLevel")) 
where   P.id IN (#--EXPLAIN
			SELECT DISTINCT merged.student_id
			FROM
                (#-- Associated group with this advisor
					SELECT S.person_id AS student_id,
						#--F.person_id AS faculty_id, #--removed due to pushdown
						F.org_permissionset_id AS permissionset_id
					FROM org_group_students AS S
					INNER JOIN org_group_faculty AS F ON F.org_group_id = S.org_group_id and F.deleted_at is null
					WHERE S.deleted_at is null  AND F.person_id=231679 #--We manually push down the faculty criteria for performance
					UNION ALL #-- Associated course with this advisor
						SELECT S.person_id AS student_id,
								#--F.person_id AS faculty_id, #--removed due to pushdown
							   F.org_permissionset_id AS permissionset_id
                                FROM org_course_student AS S
                                INNER JOIN org_courses AS C ON C.id = S.org_courses_id AND C.deleted_at is null
                                INNER JOIN org_course_faculty AS F ON F.org_courses_id = S.org_courses_id AND F.deleted_at is null
                                INNER JOIN org_academic_terms AS OAT ON OAT.id = C.org_academic_terms_id  AND OAT.end_date >= now() AND OAT.deleted_at is null
                                WHERE S.deleted_at is null  AND F.person_id=231679 #--We manually push down the faculty criteria for performance
                 ) AS merged
			INNER JOIN org_person_student AS P ON P.person_id=merged.student_id AND P.deleted_at IS NULL AND P.organization_id = 20
			INNER JOIN org_permissionset OPS ON merged.permissionset_id = OPS.id AND OPS.accesslevel_ind_agg = 1
			#  AND OPS.risk_indicator = 1 #This check is not required to get student ids
			#--We pushed down this criteria for performance
			#--WHERE
			#--          merged.faculty_id = 2
			)
AND acl.deleted_at is null
GROUP BY P.id 
ORDER BY student DESC 
LIMIT 0,550;